<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<title>y</title>
<section class="container mt-4 hero-section py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3"></h1>
        <p class="lead mb-0"></p>
    </div>
</section>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cookies Policy — [Your Company Name]</title>
  <style>body{font-family:Inter,Arial,sans-serif;max-width:860px;margin:32px auto;padding:0 18px}h1{font-size:28px}h2{font-size:18px}p,li{line-height:1.6}</style>
</head>

  <h1>Cookies Policy</h1>
  <p><strong>Effective date:</strong> [Effective Date]</p>

  <p>We use cookies and similar tracking technologies to improve your experience and for analytics, security, and advertising. Cookies are small text files placed on your device when you visit our site.</p>

  <h2>Types of cookies we use</h2>
  <ul>
    <li><strong>Essential cookies:</strong> required for login, order processing, and secure pages.</li>
    <li><strong>Performance & analytics:</strong> to measure and analyze site usage.</li>
    <li><strong>Functional:</strong> to remember preferences and language settings.</li>
    <li><strong>Advertising & targeting:</strong> to show relevant ads and offers (may involve third parties).</li>
  </ul>

  <h2>Managing cookies</h2>
  <p>You can change cookie preferences via your browser settings or device. Blocking essential cookies may break parts of the website. For further control we may provide an in-site preference center.</p>

  <h2>Third-party cookies</h2>
  <p>Third-party partners (analytics, advertising, payment providers) may set cookies — their policies apply for those cookies.</p>

  <p>Contact: <a href="mailto:[Contact Email]">[Contact Email]</a>.</p>



<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.hero-section {
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,100 0,0 1000,0 1000,80"/></svg>');
    background-size: cover;
}

.card-header {
    border: none !important;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 0 !important;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
}

#footer{
    display: none;
}
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<?= $this->endSection() ?>