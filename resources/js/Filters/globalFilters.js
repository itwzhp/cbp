import moment from 'moment'
export const globalFilters = {
    dateFormat(value) {
        return moment(value * 1000).locale(window.navigator.language).format('YYYY-MM-DD HH:mm')
    }
}
