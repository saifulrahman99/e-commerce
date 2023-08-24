(function ($) {

    "use strict"; // Start of use strict

    var SufeeAdmin = {

        pieFlot: function () {
            var os = document.getElementById('arr_os').innerHTML;


            // for (i in os) {
            // console.log(os[i]);
            // }
            var data = [
                {
                    label: "Android",
                    data: document.getElementById('osAndroid').value,
                    color: "#8fc9fb"
                },
                {
                    label: "Linux",
                    data: document.getElementById('osLinux').value,
                    color: "#007BFF"
                },
                {
                    label: "Windows 10",
                    data: document.getElementById('osWindows 10').value,
                    color: "#00c292"
                },
                {
                    label: "iPhone",
                    data: document.getElementById('osiPhone').value,
                    color: "#32c39f"
                },
                {
                    label: "Mac OS X",
                    data: document.getElementById('osMac OS X').value,
                    color: "#e3cb44"
                },
                {
                    label: "Windows 7",
                    data: document.getElementById('osWindows 7').value,
                    color: "#f77f43"
                },
                {
                    label: "Windows XP",
                    data: document.getElementById('osWindows XP').value,
                    color: "#36f5cf"
                },
                {
                    label: "Ubuntu",
                    data: document.getElementById('osUbuntu').value,
                    color: "#c527f5"
                },
                {
                    label: "Unknown OS Platform",
                    data: document.getElementById('osUnknown OS Platform').value,
                    color: "#F44336"
                }
            ];

            var plotObj = $.plot($("#flot-pie"), data, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: false,

                        }
                    }
                },
                grid: {
                    hoverable: true
                },
                tooltip: {
                    show: true,
                    content: "%p.0%, %s, n=%n", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            });
        }

    };

    $(document).ready(function () {
        SufeeAdmin.pieFlot();
    });

})(jQuery);
