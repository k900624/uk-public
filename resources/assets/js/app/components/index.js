import Vue from 'vue'
import Modal from './Modal'
import Button from './Button'
import Spinner from './Spinner'

// Components that are registered globaly.
[
	Modal,
	Button,
	Spinner,
].forEach(Component => {
	Vue.component(Component.name, Component)
})
