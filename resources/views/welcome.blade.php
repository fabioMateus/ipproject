<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <svg viewBox="11.8 9 16 22" class="mouse"><path d="M20,21l4.5,8l-3.4,2l-4.6-8.1L12,29V9l16,12H20z"></path></svg>
    <style>
        body {
            cursor: none;
            padding: 0 20px;
            min-height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        svg {
            width: 40px;
            top: 0;
            left: 0;
            position: fixed;
        }
        h1 {
            text-align: center;
            opacity: 0.5;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        const el = document.querySelector('.mouse');

        var middleY = $(window).scrollTop() + $(window).height() / 2;
        var middleX = $(window).scrollTop() + $(window).width() / 2;

        alert(middleY);
        alert(middleX);

        function updateMouse(x, y) {
            x = middleX + (x * middleX);
            y = middleY + (-y * middleY);

            el.style.transform = `translate(${x}px, ${y}px)`;
        }

        function updatePositionFunction(){
            getLastPosition();
            setTimeout(updatePositionFunction, 500);
        }

        function getLastPosition()
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');            
            $.ajax({
                /* the route pointing to the post function */
                url: '/postajax',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    updateMouse (data.x, data.y);
                }
            }); 
        }

        updatePositionFunction();

    </script>
</html>
