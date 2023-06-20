// https://qiita.com/kan_dai/items/b1850750b883f83b9bee


// https://developer.mozilla.org/en-US/docs/Web/API/Window/DOMContentLoaded_event
// https://developer.mozilla.org/en-US/docs/Web/API/Document/DOMContentLoaded_event
document.addEventListener("DOMContentLoaded", function() {

    const weeks = ['S', 'M', 'T', 'W', 'T', 'F', 'S']
    // https://www.w3schools.com/jsref/jsref_obj_date.asp
    const date = new Date()  // Returns the day of the month (from 1-31)
    let year = date.getFullYear() // Returns the year
    let month = date.getMonth() + 1 // Returns the month (from 0-11)

    function showCalendar(year, month) {
        const calendarHtml = createCalendar(year, month)
        const sec = document.createElement('section')
        sec.innerHTML = calendarHtml // create HTML
        document.querySelector('#calendar').appendChild(sec) // append created HTML to #calendar

        month++
        // if the month is bigger than 12(Dec) show 1(Jan) of next year
        if (month > 12) {
            year++
            month = 1
        }
    }

    function createCalendar(year, month) {
        
        const startDate = new Date(year, month - 1, 1) // first date of the month
        const endDate = new Date(year, month,  0) // last date of the month
        const endDayCount = endDate.getDate() // last day of the month
        const lastMonthEndDate = new Date(year, month - 1, 0) // last date of revious month
        const lastMonthendDayCount = lastMonthEndDate.getDate() // last day of revious month
        const startDay = startDate.getDay() // get the day of the first day of the month

        let dayCount = 1 // count day
        let calendarHtml = '' // variable to create HTML

        // create HTML: year and month i.g. 2020/10
        calendarHtml += '<p><strong>' + year  + '/' + month + '</strong></p>'
        // create HTML: weeks and date
        calendarHtml += '<table>'

        // weeks (Sun - Sat)
        for (let i = 0; i < weeks.length; i++) {
            calendarHtml += '<td>' + weeks[i] + '</td>'
        }

        // number of week row
        for (let w = 0; w < 6; w++) {
            calendarHtml += '<tr>'

            // date per week
            for (let d = 0; d < 7; d++) {
                if (w == 0 && d < startDay) {
                    let num = lastMonthendDayCount - startDay + d + 1
                    calendarHtml += '<td class="is-disabled">' + num + '</td>'
                } else if (dayCount > endDayCount) {
                    let num = dayCount - endDayCount
                    calendarHtml += '<td class="is-disabled">' + num + '</td>'
                    dayCount++
                } else {
                    calendarHtml += '<td>' + dayCount + '</td>'
                    dayCount++
                }
            }
            calendarHtml += '</tr>'
        }
        calendarHtml += '</table>'

        return calendarHtml
    }

    // change month
    function moveCalendar(e) {
        document.querySelector('#calendar').innerHTML = ''

        // go to previous month
        if (e.target.id === 'prev') {
            month--

            if (month < 1) {
                year--
                month = 12
            }
        }

        // go to next month
        if (e.target.id === 'next') {
            month++

            if (month > 12) {
                year++
                month = 1
            }
        }

        showCalendar(year, month)
    }

    document.querySelector('#prev').addEventListener('click', moveCalendar)
    document.querySelector('#next').addEventListener('click', moveCalendar)

    showCalendar(year, month)
});