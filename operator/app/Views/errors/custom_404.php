
<?php
// 设置404响应头
header("HTTP/1.0 404 Not Found");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }
        .error-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 90%;
        }
        .error-code {
            font-size: 8em;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
        }
        .error-description {
            color: #666;
            margin-bottom: 30px;
        }
        .home-link {
            display: inline-block;
            padding: 12px 30px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .home-link:hover {
            background-color: #2980b9;
        }
        .search-box {
            margin-top: 30px;
        }
        .search-box input {
            padding: 10px;
            width: 70%;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
        }
        .search-box button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        @media (max-width: 600px) {
            .error-code {
                font-size: 6em;
            }
            .error-message {
                font-size: 1.2em;
            }
            .search-box input {
                width: 60%;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-message">Page Not Found</h1>
        <p class="error-description">
            Sorry, the page you are looking for might have been removed, 
            had its name changed, or is temporarily unavailable.
        </p>
        <a href="/" class="home-link">Go to Homepage</a>
        
     
    </div>
</body>
</html>
