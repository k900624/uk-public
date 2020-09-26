<?php

/**
 * Response Library
 * Handle response for ajax request which is sent
 * by the SX.Ajax.request() Javascript function
 *
 * Rework 09.2019 SillexLab (sillexlab@gmail.com)
 */

namespace App\Services;

class ResponseLib
{
    protected $data;

    /**
     * Add callback Javascript
     *
     * @access  public
     * @param   string $script
     * @return  void
     */
    public function script($script)
    {
        $this->data['scripts'][] = $script;
    }

    /**
     * Generate Dialog script
     *
     * @access  private
     * @param   array $data
     * @return  void
     */
    public function dialog($data)
    {
        $dialog_id = (empty($data['id'])) ?
            'dialog-' . mt_rand(1000000, 9999999) :
            $data['id'];
        $this->set_id($dialog_id);

        if (!empty($data['class'])) {
            $this->set_class($data['class']);
        }

        if (!empty($data['title'])) {
            $this->set_title($data['title']);
        }

        if (!empty($data['body'])) {
            $this->set_body($data['body']);
        }

        if (!empty($data['footer'])) {
            $this->set_footer($data['footer']);
        }

        if (!empty($data['size'])) {
            $this->set_size($data['size']);
        }

        $html = $this->html();
        $json_html = json_encode($html);

        /*
         * - Append dialog HTML to <body>.
         * - Store reference of the button that toggles this dialog (caller)
         * on every async forms of the dialog.
         * - Launch the dialog.
         * - Register an event to destroy the dialog after it was closed
         * (must use setTimeout to prevent the dialog from being completely removed
         * before other scripts, which retrieve dialog's data, are executed,
         * especially for dialogs that have no hidden effect or for IE).
         */
        $code = <<< JS
$('body').append({$json_html});
$('#{$dialog_id}')
  .modal().on('hidden.bs.modal', function(e) {
    setTimeout(function() {
      $(e.target).remove();
    }, 1);
  });
JS;
        $this->script($code);
    }

    /**
     * Send response to SX.Ajax.response() Javascript function
     * @param bool $return
     * @return \Illuminate\Http\JsonResponse
     */
    public function send($return = false)
    {
        if (!empty($this->data)) {
            if (request()->ajax()) {
                $json_data = json_encode($this->data);
                if ($return) {
                    return $json_data;
                } else {
                    echo $json_data;
                    exit;
                }
            }
        }
    }

    /**
     * Set dialog id
     * @param $id
     */
    public function set_id($id)
    {
        $this->data['id'] = $id;
    }

    /**
     * Set modal modificator class
     * @param $class
     */
    public function set_class($class)
    {
        $this->data['class'] = $class;
    }

    /**
     * Set dialog title
     * @param $title
     */
    public function set_title($title)
    {
        $this->data['title'] = $title;
    }

    /**
     * Set dialog body
     * @param $body
     */
    public function set_body($body)
    {
        $this->data['body'] = $body;
    }

    /**
     * Set dialog footer
     * @param $footer
     */
    public function set_footer($footer)
    {
        $this->data['footer'] = $footer;
    }

    /**
     * Set dialog size
     * @param $size
     */
    public function set_size($size)
    {
        switch ($size) {
            case 'small':
                $this->data['size'] = 'modal-sm';
                break;
            case 'middle':
                $this->data['size'] = '';
                break;
            case 'large':
                $this->data['size'] = 'modal-lg';
                break;
            case 'full':
                $this->data['size'] = 'modal-full';
                break;
            default:
                $this->data['size'] = '';
        }
    }

    /**
     * Get dialog HTML
     *
     */
    public function html()
    {
        if (empty($this->data['id'])) {
            $this->data['id'] = 'dialog-' . mt_rand(1000000, 9999999);
        }
        return view('modals/dialog')->with($this->data)->render();
    }
}
