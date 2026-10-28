export default (function(){
    jQuery(window).scroll(function() {
        var $height = $(window).scrollTop();

        if($height > 10) {
            $('#header').addClass('sticky');
        } else {
            $('#header').removeClass('sticky');
            console.log($height);
        }
    });

    $(document).ready(function () {
        var $form = $('#form-nesletter')
        if ($form.length > 0) {
            $('form#form-nesletter input[type="submit"]').bind('click', function (event) {
                event.preventDefault();
                console.log('suscribiendo..');
                if (event) event.preventDefault()
                register($form)
            })
        }
    })

    function register($form) {
        $('#mc-embedded-subscribe').val('Sending...');
        $.ajax({

            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
            cache: false,
            dataType: 'jsonp',
            contentType: 'application/json; charset=utf-8',
            error: function (err) {
                $('#mce-EMAIL').css('borderColor', '#ffffff')
                    $('#subscribe-result').css('color', 'rgb(53, 114, 210)')
                    $('#subscribe-result').html('<p>Gracias por su suscripción.</p>')
                    $('#mce-EMAIL').val('')
                    $('#mce-FNAME').val('')
                    $('#mce-LNAME').val('')

            },
            success: function (data) {

                console.log(data);
                $('#mc-embedded-subscribe').val('subscribe')
                if (data.result === 'success') {
                    // Yeahhhh Success
                    console.log(data.msg)
                    $('#mce-EMAIL').css('borderColor', '#ffffff')
                    $('#subscribe-result').css('color', 'rgb(53, 114, 210)')
                    $('#subscribe-result').html('<p>Thank you for subscribing. We have sent you a confirmation email.</p>')
                    $('#mce-EMAIL').val('')
                } else {
                    // Something went wrong, do something to notify the user.
                    console.log(data.msg)
                    $('#mce-EMAIL').css('borderColor', '#ff8282')
                    $('#subscribe-result').css('color', '#ff8282')
                    $('#subscribe-result').html('<p>' + data.msg.substring(4) + '</p>')
                }
            }
        })
    }


    // Menu Mobile

    // $('.navbar-toggler').on('click', function(){
    //     $(this).siblings('#navbarSupportedContent').toggleClass('show');
    // })

    // $('.dropbtn').on('click', function(){
    //     $(this).siblings('.dropdown-content').toggleClass('show');
    // })

    // End


    // Video Wrapper

    $(function() {
        $( "iframe" ).wrap( "<div class='videoContainer'></div>" );
        $( "iframe" ).addClass( "video" );
    });


    // Suscription

    $('#btn-suscribe').on('click',function(event) {

        var url =  $('#form-nesletter').attr('action');
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'email'             : $('input[name=email]').val(),
        };

        // process the form
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : url, // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })
            // using the done promise callback
            .done(function(data) {

                if(data.errors){

                    $('#server-results').html(data.errors.email);
                    $('#server-results').removeClass('good-results');
                    $('#server-results').addClass('bad-results');
                    $('#server-results').show();

                    console.log(data.errors.email);
                }else{

                    $('#server-results').html(data.success);
                    $('#server-results').removeClass('bad-results');
                    $('#server-results').addClass('good-results');
                    $('#server-results').show();
                    console.log(data.success);

                }




                // here we will handle errors and validation messages
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });


    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function filterTagFunction() {
        var filter, a, i;
        filter = $('#myTagInput').val().toUpperCase();
        var div = document.getElementById("myTagDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            var txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }


    function filterCatFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myCatInput");
        filter = input.value.toUpperCase();
        var div = document.getElementById("myCatDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            var txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }

    console.log('xd2');
}());
