<?php

namespace App\Http\Middleware;

use Closure;
use \Request;
use \WhichBrowser\Parser as WhichBrowser;
use Illuminate\Support\Facades\Auth;
use App\Models\Statistic as Model;

class Statistic
{
    protected $ua;
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->ua = new WhichBrowser(getallheaders(), ['detectBots' => true]);
        
        $this->setStatistic();
        
        return $next($request);
    }
    
    private function isAdmin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return true;
        }
        return false;
    }
    
    /**
     * Detect bots
     * @return boolean
     */
    private function isBot()
    {
        if (isset($this->ua->device->type) && $this->ua->device->type == 'bot') return false;
      
        // Пополняемый список ботов
        $bot_regex = '/BotLink|bingbot|AhrefsBot|ahoy|AlkalineBOT|anthill|appie|arale|araneo|AraybOt|ariadne|arks|ATN_Worldwide|Atomz|bbot|Bjaaland|Ukonline|borg\-bot\/0\.9|boxseabot|bspider|calif|christcrawler|CMC\/0\.01|combine|confuzzledbot|CoolBot|cosmos|Internet Cruiser Robot|cusco|cyberspyder|cydralspider|desertrealm, desert realm|digger|DIIbot|grabber|downloadexpress|DragonBot|dwcp|ecollector|ebiness|elfinbot|esculapio|esther|fastcrawler|FDSE|FELIX IDE|ESI|fido|H�m�h�kki|KIT\-Fireball|fouineur|Freecrawl|gammaSpider|gazz|gcreep|golem|googlebot|griffon|Gromit|gulliver|gulper|hambot|havIndex|hotwired|htdig|iajabot|INGRID\/0\.1|Informant|InfoSpiders|inspectorwww|irobot|Iron33|JBot|jcrawler|Teoma|Jeeves|jobo|image\.kapsi\.net|KDD\-Explorer|ko_yappo_robot|label\-grabber|larbin|legs|Linkidator|linkwalker|Lockon|logo_gif_crawler|marvin|mattie|mediafox|MerzScope|NEC\-MeshExplorer|MindCrawler|udmsearch|moget|Motor|msnbot|muncher|muninn|MuscatFerret|MwdSearch|sharp\-info\-agent|WebMechanic|NetScoop|newscan\-online|ObjectsSearch|Occam|Orbsearch\/1\.0|packrat|pageboy|ParaSite|patric|pegasus|perlcrawler|phpdig|piltdownman|Pimptrain|pjspider|PlumtreeWebAccessor|PortalBSpider|psbot|Getterrobo\-Plus|Raven|RHCS|RixBot|roadrunner|Robbie|robi|RoboCrawl|robofox|Scooter|Search\-AU|searchprocess|Senrigan|Shagseeker|sift|SimBot|Site Valet|skymob|SLCrawler\/2\.0|slurp|ESI|snooper|solbot|speedy|spider_monkey|SpiderBot\/1\.0|spiderline|nil|suke|http:\/\/www\.sygol\.com|tach_bw|TechBOT|templeton|titin|topiclink|UdmSearch|urlck|Valkyrie libwww\-perl|verticrawl|Victoria|void\-bot|Voyager|VWbot_K|crawlpaper|wapspider|WebBandit\/1\.0|webcatcher|T\-H\-U\-N\-D\-E\-R\-S\-T\-O\-N\-E|WebMoose|webquest|webreaper|webs|webspider|WebWalker|wget|winona|whowhere|wlm|WOLP|WWWC|none|XGET|Nederland\.zoek|AISearchBot|woriobot|NetSeer|Nutch|YandexBot|YandexMobileBot|SemrushBot|FatBot|MJ12bot|DotBot|AddThis|baiduspider|SeznamBot|mod_pagespeed|CCBot|openstat.ru\/Bot|m2e|rambler|google|aport|yahoo|msnbot|mail|yandex|uptime|vkShare|Crazy Browser|Crazy|python-requests|C-T bot|uptime|Babya|Deepnet Explorer|Deepnet|statdom|Crawler|ask jeeves|infoseek|lycos|YandexWebmaster|CRAZYWEBCRAWLER|curious george|ia_archiver|Uptimebot|oBot/i';

        $userAgent = empty($_SERVER['HTTP_USER_AGENT']) ? false : $_SERVER['HTTP_USER_AGENT'];
        $isBot = ! $userAgent || preg_match($bot_regex, $userAgent);

        return $isBot;
    }
    
    /**
     * Set statistic
     */
    private function setStatistic()
    {
        try {

            // Отсекаем админов и ботов
            if ($this->isAdmin() || $this->isBot()) return false;

            // Старт
            $params = [
                'browser'             => (isset($this->ua->browser->name)) ? $this->ua->browser->name : 'Unknown Browser',
                'browser_version'     => (isset($this->ua->browser->version->value)) ? $this->ua->browser->version->value : '',
                'platform'            => ($this->ua->os->toString()) ? $this->ua->os->toString() : 'Unknown Platform',
                'device_type'         => (isset($this->ua->device->type)) ? $this->ua->device->type : '',
                'device_manufacturer' => (isset($this->ua->device->manufacturer)) ? $this->ua->device->manufacturer : '',
                'device_model'        => (isset($this->ua->device->model)) ? $this->ua->device->model : '',
            ];

            $ip_address = Request::ip();
            $userAgent = Request::header('User-Agent');
            $uid = md5($userAgent . $ip_address);

            $statistic = Model::where('uid', $uid)->first();

            if ( ! session()->has('statistic') || $statistic == null) {

                if ($statistic) {
                    $statistic->visits++;
                    $statistic->save();
                } else {
                    $params['referrer'] = empty($_SERVER['HTTP_REFERER']) ? '' : trim($_SERVER['HTTP_REFERER']);
                    
                    if (Auth::check()) {
                        $user_id = Auth::user()->id;
                    } else {
                        $user_id = 0;
                    }
            
                    $statistic = new Model();
                    $statistic->ip_address = $ip_address;
                    $statistic->uid        = $uid;
                    $statistic->user_id    = $user_id;
                    $statistic->user_agent = ($userAgent) ? $userAgent : 'Unknown User Agent';
                    $statistic->params     = serialize($params);
                    $statistic->visits     = 1;
                    $statistic->save();
                }
                session(['statistic' => time()]);
                
            } else {
                
                // Проверяем, что сессия статистики не просрочена
                if (time() >= session('statistic') + 24 * 60 * 60) {
                    session()->forget('statistic');
                } else {
                    $update = ['last_visit' => time_now()];
                    
                    $statistic->update($update);
                }
            }

            return true;

        } catch (Exception $ex) {
            $this->notify->add($ex->getMessage(), 'error');
        }
    }
}
