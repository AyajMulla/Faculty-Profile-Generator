<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Faculty Profile Generator</title>
    
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f9e8c4, #e7c4f4);
            color: #333;
            transition: background 0.5s ease-in-out;
        }

        header {
            background: #fff;
            padding: 1.5rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        header:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        header .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 600;
            color: #4a4a4a;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        nav ul li a {
            color: #4a4a4a;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            transition: color 0.3s, transform 0.3s;
        }

        nav ul li a:hover {
            color: #6a1b9a;
            transform: scale(1.1);
        }

        .hero {
            text-align: center;
            padding: 5rem 1rem;
            background: linear-gradient(135deg, #f9e8c4, #f4c4d7);
            border-bottom-left-radius: 50% 10%;
            border-bottom-right-radius: 50% 10%;
            opacity: 0;
            animation: fadeInUp 1.2s ease forwards;
        }

        .hero h2 {
            font-size: 2.8rem;
            margin-bottom: 1rem;
            color: #6a1b9a;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #555;
        }

        .hero a {
            display: inline-block;
            padding: 1rem 2rem;
            background: #6a1b9a;
            color: white;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s, transform 0.3s;
        }

        .hero a:hover {
            background: #8835b7;
            transform: translateY(-5px);
        }

        section {
            padding: 3rem 1rem;
        }

        .features {
            text-align: center;
            padding: 3rem 0;
        }

        .features .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .features .feature {
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 1.2s ease forwards;
        }

        .features .feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .features .feature h3 {
            color: #6a1b9a;
            margin-bottom: 1rem;
        }

        .features .feature p {
            color: #555;
        }

        .how-it-works {
            background: #f9e8c4;
            color: #333;
            text-align: left;
        }

        .how-it-works ol {
            max-width: 800px;
            margin: 0 auto;
            padding-left: 1.5rem;
            list-style: decimal;
        }

        footer {
            background: #fff;
            color: #6a1b9a;
            text-align: center;
            padding: 2rem 0;
        }

        footer a {
            color: #6a1b9a;
            text-decoration: none;
            transition: color 0.3s, transform 0.3s;
        }

        footer a:hover {
            color: #8835b7;
            transform: scale(1.1);
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1 class="logo">AI Faculty Profile Generator</h1>
            <nav>
                <ul>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#how-it-works">How It Works</a></li>
                    <li><a href="#container">Contact</a></li>
                    <li><a href="view_profiles.php">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h2>Transform Faculty Profiles with AI</h2>
            <p>Effortlessly design and customize academic profiles with cutting-edge AI.</p>
            <a href="login.php">Get Started</a>
        </div>
    </section>

    <section id="features" class="features">
        <div class="container">
            <div class="feature">
                <h3>Templates</h3>
                <p>Choose from sleek, modern designs tailored for academia.</p>
            </div>
            <div class="feature">
                <h3>Recommendations</h3>
                <p>Highlight achievements with smart, data-driven suggestions.</p>
            </div>
            <div class="feature">
                <h3>Seamless Export</h3>
                <p>Download profiles in multiple formats with a single click.</p>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="how-it-works">
        <div class="container">
            <h2>How It Works</h2>
            <ol>
                <li>Sign up and log in to your account.</li>
                <li>Enter your academic and professional details.</li>
                <li>Preview and refine your profile with AI-driven insights.</li>
                <li>Export or share your profile instantly.</li>
            </ol>
        </div>
    </section>

    <footer>
        <div class="container" id="container">
            <p>&copy; 2025 AI Faculty Profile Generator. For support, contact <a href="mailto:ayajmulla2341@gmail.com">ayajmulla2341@gmail.com</a>.</p>
        </div>
    </footer>
</body>
</html>
