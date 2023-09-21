<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Your CSS styles here */
        body {
            background-image: url("login.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .border {
            width: 500px;
            height: 320px;
            border: 3px solid black;
            padding: 6px;
            background-color: #9370db;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            border: 1px solid #ddd;
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        .rating {
            margin-bottom: 20px;
        }

        .rating h3,
        .comment-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .stars {
            display: flex;
            align-items: center;
        }

        .stars input[type="radio"] {
            display: none;
        }

        .stars label {
            cursor: pointer;
            color: #ddd;
            margin-right: 5px;
        }

        .stars label:before {
            content: "\2605";
            font-size: 24px;
        }

        .stars input[type="radio"]:checked ~ label:before {
            content: "\2605";
            color: #ffcc00;
        }

        .comment-section form div {
            margin-bottom: 10px;
        }

        .comment-section label {
            display: inline-block;
            width: 80px;
        }

        .comment-section input[type="text"],
        .comment-section textarea {
            width: 90%;
            padding: 5px;
        }

        .comment-section input[type="submit"] {
            padding: 10px 20px;
            background-color: #ffcc00;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .comment-section input[type="submit"]:hover {
            background-color: #ffa500;
        }

        .comment-section input[type="submit"]:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="border">
        <legend>
            <h3>Rate the Landlord:</h3>
        </legend>
        <div class="rating">
            <div class="stars">
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1"></label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2"></label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3"></label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4"></label>
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5"></label>
            </div>
        </div>

        <div class="comment-section">
            <h3>Leave a review:</h3>
            <form>
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Your Name">
                </div>
                <div>
                    <label for="comment">Comment:</label>
                    <textarea id="comment" name="comment" placeholder="Write your comment here"></textarea>
                </div>
                <div>
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
