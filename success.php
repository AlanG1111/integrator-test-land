<?php
$pixel_id = isset($_GET['pixel']) ? htmlspecialchars($_GET['pixel']) : '';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дякуємо за замовлення!</title>
</head>
<body>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 50vh; text-align: center;">
        <h1>Дякуємо за ваше замовлення!</h1>
        <p>Наш менеджер зв'яжеться з вами найближчим часом.</p>
    </div>

    <?php if (!empty($pixel_id)) : ?>
        <!-- Facebook Pixel Code -->
        <script>
          (function(f,b,e,v,n,t,s) {
            if(f.fbq)return; n=f.fbq=function() {
              n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if(!f._fbq)f._fbq=n; n.push=n; n.loaded=!0; n.version='2.0';
            n.queue=[]; t=b.createElement(e); t.async=!0;
            t.src=v; s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)
          })(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
          
          fbq('init', '<?php echo $pixel_id; ?>'); // Используем переданный ID пикселя
          fbq('track', 'Lead');
        </script>
        <noscript>
          <img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=<?php echo $pixel_id; ?>&ev=Lead&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
    <?php endif; ?>
</body>
</html>
