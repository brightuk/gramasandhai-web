<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Not Found</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 50px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {

            0%,
            100% {
                transform: rotate(0deg);
            }

            50% {
                transform: rotate(180deg);
            }
        }

        .icon {
            font-size: 80px;
            color: #ff6b6b;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: bold;
            position: relative;
            z-index: 1;
        }

        .error-code {
            background: #ff6b6b;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 30px;
            font-weight: bold;
        }

        p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 40px;
            position: relative;
            z-index: 1;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }

        .btn-secondary {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .status-info {
            background: rgba(52, 152, 219, 0.1);
            border-left: 4px solid #3498db;
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
            text-align: left;
            position: relative;
            z-index: 1;
        }

        .status-info h3 {
            color: #3498db;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .status-info ul {
            list-style: none;
            padding-left: 0;
        }

        .status-info li {
            margin: 8px 0;
            color: #555;
        }

        .status-info li::before {
            content: "❗";
            margin-right: 10px;
        }

        .contact-info {
            background: rgba(46, 204, 113, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            position: relative;
            z-index: 1;
        }

        .contact-info h3 {
            color: #2ecc71;
            margin-bottom: 15px;
        }

        .contact-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .contact-link {
            color: #2ecc71;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .contact-link:hover {
            color: #27ae60;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
                margin: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .icon {
                font-size: 60px;
            }

            .actions {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 250px;
            }
        }
    </style>
</head>
<?php include(APPPATH . 'Views/templates/config.php'); ?>

<body>
    <div class="container">
        <div class="icon">🔍</div>

        <h1>Shop Not Found</h1>

        <div class="error-code">Error Code: 404</div>

        <p>We're sorry, but the shop you're looking for could not be found. It may have been moved, deleted, or the URL might be incorrect.</p>

        <div class="status-info">
            <h3>Possible reasons:</h3>
            <ul>
                <li>The shop URL is incorrect or has changed</li>
                <li>The shop may have been temporarily removed</li>
                <li>There might be a typo in the address</li>
                <li>The shop may no longer be available</li>
            </ul>
        </div>

        <div class="actions">
            <button class="btn btn-primary" onclick="window.history.back()">
                ⬅️ Go Back
            </button>
            <!-- <a href="/" class="btn btn-secondary">
                🏠 Home Page
            </a> -->
        </div>

        <div class="contact-info">
            <h3>Need Help?</h3>
            <div class="contact-links">
                <a href="tel:+1234567890" class="contact-link">📞 Call Us</a>
                <a href="mailto:support@yourshop.com" class="contact-link">✉️ Email Support</a>
                <a href="https://twitter.com/yourshop" class="contact-link">🐦 Twitter</a>
            </div>
        </div>
    </div>

    <script>
        // For PHP integration
        <?= $burl ?>
        const baseUrl = '<?= isset($burl) ? $burl : "" ?>' || window.location.origin;

        // Add a simple notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'info' ? '#3498db' : '#e74c3c'};
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                z-index: 1000;
                animation: slideIn 0.3s ease-out;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Add CSS for slide-in animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>