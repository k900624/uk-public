import Vue from 'vue';
import VueRouter from 'vue-router';
import Profile from '@pages/Profile/Home.vue';
import ProfileMobile from '@pages/Profile/Mobile/Home.vue';
import Faq from '@pages/Faq/Faq.vue';
import FaqMobile from '@pages/Faq/Mobile/Faq.vue';
import Handbook from '@pages/Handbook/Handbook.vue';
import HandbookMobile from '@pages/Handbook/Mobile/Handbook.vue';
import HandbookShow from '@pages/Handbook/HandbookShow.vue';
import HandbookShowMobile from '@pages/Handbook/Mobile/HandbookShow.vue';
// import Contacts from '@pages/Pages/Contacts.vue';
// import ContactsMobile from '@pages/Pages/Mobile/Contacts.vue';
// import About from '@pages/Pages/About.vue';
// import AboutMobile from '@pages/Pages/Mobile/About.vue';
import Page from '@pages/Pages/Page.vue';
import PageMobile from '@pages/Pages/Mobile/Page.vue';
import Personal from '@pages/Profile/Personal.vue';
import PersonalMobile from '@pages/Profile/Mobile/Personal.vue';
import EditForm from '@pages/Profile/EditForm.vue';
import EditFormMobile from '@pages/Profile/Mobile/EditForm.vue';
import Payments from '@pages/Payments/Payments.vue';
import PaymentsMobile from '@pages/Payments/Mobile/Payments.vue';
import Paying from '@pages/Payments/Paying.vue';
import PayingMobile from '@pages/Payments/Mobile/Paying.vue';
import Invoice from '@pages/Payments/Invoice.vue';
import InvoiceMobile from '@pages/Payments/Mobile/Invoice.vue';
import MetersData from '@pages/MetersData/MetersData.vue';
import MetersDataMobile from '@pages/MetersData/Mobile/MetersData.vue';
import Polls from '@pages/Polls/Polls.vue';
import PollsMobile from '@pages/Polls/Mobile/Polls.vue';
import Services from '@pages/Services/Services.vue';
import ServicesMobile from '@pages/Services/Mobile/Services.vue';
import Settings from '@pages/Settings/Settings.vue';
import SettingsMobile from '@pages/Settings/Mobile/Settings.vue';
import NewsEvents from '@pages/NewsEvents/NewsEvents.vue';
import NewsEventsMobile from '@pages/NewsEvents/Mobile/NewsEvents.vue';
import NewsShow from '@pages/NewsEvents/NewsShow.vue';
import NewsShowMobile from '@pages/NewsEvents/Mobile/NewsShow.vue';
import NewsCategoryShow from '@pages/NewsEvents/NewsCategoryShow.vue';
import NewsCategoryShowMobile from '@pages/NewsEvents/Mobile/NewsCategoryShow.vue';
import Page404 from '@pages/Errors/Page404.vue';
import Page404Mobile from '@pages/Errors/Mobile/Page404.vue';

Vue.use(VueRouter);

// lazyload components, use: component: page('Pages/Page.vue'),
// function page (path) {
// 	return () => import(/* webpackChunkName: '' */ `@pages/${path}`).then(m => m.default || m)
// }

export default new VueRouter({

	mode: 'history',
	scrollBehavior(to, from, savedPosition) {
		if (to.hash) {
			return { selector: to.hash }
		} else if (savedPosition) {
			return savedPosition;
		} else {
			return { x: 0, y: 0}
		}
	},
	routes: [
		{
			name: 'profile',
			path: '/profile',
			meta: {sidebar: 'profile'},
			components: {
				default: Profile,
				mobile: ProfileMobile
			}
		},
		{
			name: 'personal',
			path: '/profile/personal',
			meta: {sidebar: 'profile'},
			components: {
				default: Personal,
				mobile: PersonalMobile
			}
		},
		{
			name: 'editForm',
			path: '/profile/edit',
			meta: {sidebar: 'profile'},
			components: {
				default: EditForm,
				mobile: EditFormMobile
			}
		},
		{
			name: 'payments',
			path: '/profile/payments',
			meta: {sidebar: 'profile'},
			components: {
				default: Payments,
				mobile: PaymentsMobile
			}
		},
		{
			name: 'paying',
			path: '/profile/paying',
			meta: {sidebar: 'profile'},
			components: {
				default: Paying,
				mobile: PayingMobile
			}
		},
		{
			name: 'invoice',
			path: '/profile/invoice',
			meta: {sidebar: 'profile'},
			components: {
				default: Invoice,
				mobile: InvoiceMobile
			}
		},
		{
			name: 'meters_data',
			path: '/profile/meters_data',
			meta: {sidebar: 'profile'},
			components: {
				default: MetersData,
				mobile: MetersDataMobile
			}
		},
		{
			name: 'polls',
			path: '/profile/polls',
			meta: {sidebar: 'profile'},
			components: {
				default: Polls,
				mobile: PollsMobile
			}
		},
		{
			name: 'services',
			path: '/profile/services',
			meta: {sidebar: 'profile'},
			components: {
				default: Services,
				mobile: ServicesMobile
			}
		},
		{
			name: 'settings',
			path: '/profile/settings',
			meta: {sidebar: 'profile'},
			components: {
				default: Settings,
				mobile: SettingsMobile
			}
		},
		{
			name: 'news_events',
			path: '/profile/news_events',
			meta: {sidebar: 'profile'},
			components: {
				default: NewsEvents,
				mobile: NewsEventsMobile
			}
		},
		{
			name: 'news_show',
			path: '/profile/news/:alias',
			meta: {sidebar: 'news'},
			components: {
				default: NewsShow,
				mobile: NewsShowMobile
			}
		},
		{
			name: 'news_category_show',
			path: '/profile/news/category/:category_alias',
			meta: {sidebar: 'news'},
			components: {
				default: NewsCategoryShow,
				mobile: NewsCategoryShowMobile
			}
		},
		{
			name: 'faq',
			path: '/faq',
			meta: {sidebar: 'faq'},
			components: {
				default: Faq,
				mobile: FaqMobile
			}
		},
		// {
		// 	name: 'page',
		// 	path: '/page/:page_alias',
		// 	meta: {sidebar: 'profile'},
		// 	components: {
		// 		default: Page,
		// 		mobile: PageMobile
		// 	}
		// },
		{
			name: 'about',
			path: '/about',
			meta: {sidebar: 'profile', alias: 'about'},
			components: {
				default: Page,
				mobile: PageMobile
			}
		},
		{
			name: 'contacts',
			path: '/contacts',
			meta: {sidebar: 'profile', alias: 'contacts'},
			components: {
				default: Page,
				mobile: PageMobile
			}
		},
		{
			name: 'handbook',
			path: '/handbook',
			meta: {sidebar: 'profile'},
			components: {
				default: Handbook,
				mobile: HandbookMobile
			}
		},
		{
			name: 'handbook_show',
			path: '/handbook/:alias',
			meta: {sidebar: 'profile'},
			components: {
				default: HandbookShow,
				mobile: HandbookShowMobile
			}
		},
		{
			name: 'logout',
			path: '/logout'
		},
		{
			name: 'Page404',
			path: '/error-404',
			components: {
				default: Page404,
				mobile: Page404Mobile
			}
		},
		{
			// 404 redirect to home
			path: '*',
			redirect: {
				name: 'Page404',
				component: Page404
			}
		}
	]

});

