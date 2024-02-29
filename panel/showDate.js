showDate();
setInterval(showDate, 60000);
function showDate() {
    let dateObj = new Date();
    var day = dateObj.getUTCDate();
    var month = dateObj.getUTCMonth() + 1;
    var year = dateObj.getUTCFullYear();

    let currentDate = day + "." + month + "." + year;

    document.getElementById("date")
            .innerHTML = currentDate;
}