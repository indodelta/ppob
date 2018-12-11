$(document).ready(function() {

    var color = document.getElementById("txbcolor").value;
    var tanggalawal = document.getElementById("txbtanggalawaltersedia").value;
    var tanggalakhir = document.getElementById("txbtanggalakhirtersedia").value;

    $('#calendar').fullCalendar({
        lang: 'id',
        defaultView: 'month',
        contentHeight: 350,
        aspectRatio: 2,
        handleWindowResize: true,
        selectable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: '',
        },
        select: function(start, end) {

            var today = new Date();
            var tglawal = new Date(tanggalawal);
            var tglakhir = new Date(tanggalakhir);

            if (start < tglawal || start > tglakhir) {
                alert("Tidak bisa memilih di tanggal ini!");
            } else {

                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('rerenderEvents')
                var title = "Tanggal Dipilih";
                var eventData;
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
                $('#calendar').fullCalendar('renderEvent', eventData, true);

                var tanggalpilih = start.format();
                document.getElementById("txbpilihtanggal").value = tanggalpilih;
                document.getElementById("txbpilihantanggal").value = dateindowithyear(tanggalpilih);



            }

        }

    });

});
