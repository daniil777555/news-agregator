<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Administration panel</title>
</head>
<body>
    <div class="adm-container">
        <form action="#" class="adm-form form-add-news" method="post">
            <label for="images" class="adm-form-label add-news-label">Add images</label>
            <input type="file" name="images" id="images" class="adm-form-input adm-input-file">

            <label for="title" class="adm-form-label add-news-label">Enter title</label>
            <input type="text" name="title" id="title" class="adm-form-input">

            <label for="newBody" class="adm-form-label add-news-label">Enter text for news</label>
            <textarea name="newBody" id="newBody" cols="50" class="adm-form-input" rows="10"></textarea>

            <label for="hashtags" class="adm-form-label add-news-label">Enter hashtags through space and without "#"</label>
            <input type="text" name="hashtags" id="hashtags" class="adm-form-input">

            <label for="date" class="adm-form-label add-news-label">Enter date</label>
            <input type="text" name="date" id="date" class="adm-form-input">

            <button type="submit" class="adm-form-btn">Add new news</button>
        </form>
    </div>
</body>
</html>