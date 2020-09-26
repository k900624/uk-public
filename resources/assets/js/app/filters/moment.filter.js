
import Moment from 'moment'

export default function dateFilter(date, format) {
	Moment.locale('ru');
	return Moment(date).format(format)
}
