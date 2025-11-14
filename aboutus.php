<?php
// Optional: Include header if using a template
// include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - MeroPasal</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --accent: #ffa31a;
      --accent-dark: #e68a00;
      --bg: #fffdf8;
      --card: #ffffff;
      --text: #1b1b1b;
      --muted: #6b6b6b;
      --shadow: 0 8px 20px rgba(255, 163, 26, 0.15);
      --radius: 14px;
      --transition: 0.3s ease;
    }

    * {
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background: var(--bg);
      color: var(--text);
      overflow-x: hidden;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  text-align: center;
  padding: 20px 0;
  position: sticky;
  top: 0;
  z-index: 10;
  transition: background var(--transition);
}

header a {
  text-decoration: none;       /* removes underline */
  color: inherit;              /* ensures same color as text */
}

header h1 {
  color: var(--accent);
  font-size: 30px;
  font-weight: 800;
  letter-spacing: 1px;
  text-shadow: 0 0 10px rgba(255, 163, 26, 0.3);
  transition: transform 0.3s ease;
}

header h1:hover {
  transform: scale(1.06);
}


    /* 📜 About Section */
    .about-container {
      max-width: 900px;
      margin: 60px auto;
      padding: 0 20px;
      text-align: center;
    }

    .about-container h2 {
      font-size: 2rem;
      font-weight: 700;
      color: var(--accent);
      margin-bottom: 16px;
      text-transform: uppercase;
      letter-spacing: 0.6px;
    }

    .about-container p {
      color: var(--muted);
      font-size: 1.05rem;
      line-height: 1.7;
      margin-bottom: 22px;
    }

    /* 👥 Team Section */
    .team {
      display: flex;
      justify-content: center;
      align-items: stretch;
      flex-wrap: wrap;
      gap: 30px;
      margin-top: 40px;
    }

    .team-member {
      text-decoration: none;
      color: inherit;
      flex: 1 1 260px;
      max-width: 280px;
      transition: transform var(--transition);
    }

    .team-member div {
      background: var(--card);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 24px 18px;
      text-align: center;
      transition: all var(--transition);
      position: relative;
      overflow: hidden;
    }

    .team-member div::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      height: 4px;
      width: 100%;
      background: linear-gradient(90deg, var(--accent), var(--accent-dark));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.4s ease;
    }

    .team-member div:hover::before {
      transform: scaleX(1);
    }

    .team-member:hover div {
      transform: translateY(-6px);
      box-shadow: 0 12px 25px rgba(255, 163, 26, 0.3);
    }

    .team-member img {
      width: 100%;
      height: 200px;
      object-fit: contain;
      background: #fff9f0;
      border-radius: var(--radius);
      padding: 10px;
      margin-bottom: 12px;
      transition: transform 0.4s ease;
    }

    .team-member:hover img {
      transform: scale(1.05);
    }

    .team-member h3 {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 4px;
    }

    .team-member p {
      color: var(--muted);
      font-size: 0.95rem;
    }

    /* 🦶 Footer */
    footer {
      text-align: center;
      padding: 26px 0;
      border-top: 1px solid rgba(0,0,0,0.06);
      color: var(--muted);
      font-size: 0.9rem;
      margin-top: auto;
      background: #fff;
    }

    footer a {
      color: var(--accent);
      font-weight: 600;
      text-decoration: none;
      transition: color var(--transition);
    }

    footer a:hover {
      color: var(--accent-dark);
    }

    /* 🌈 Scroll Animation */
    [data-animate] {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.6s ease-out;
    }
    [data-animate].visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* 📱 Responsive */
    @media (max-width: 720px) {
      header h1 {
        font-size: 24px;
      }
      .about-container {
        margin: 40px auto;
      }
      .team {
        gap: 20px;
      }
    }
  </style>
</head>

<body>
  <header>
    <a href="/nayaapasal/"><h1>MeroPasal</h1></a>
  </header>

  <div class="about-container" data-animate>
    <h2>About Us</h2>
    <p>Welcome to <strong>MeroPasal</strong> — your ultimate destination for cutting-edge technology products! 
    We bring you the latest gadgets, electronics, and accessories with fast shipping and exceptional service.</p>

    <p>Founded in 2025, MeroPasal has grown from a small startup into one of the fastest-growing tech e-commerce platforms. 
    Our mission is to make technology accessible, affordable, and enjoyable for everyone.</p>

    <h2>Our Team</h2>

    <div class="team">
      <a href="https://en.wikipedia.org/wiki/Shiva" class="team-member" data-animate>
        <div>
          <img src="assets/images/team1.png" alt="Shiva">
          <h3>Shiva</h3>
          <p>Founder & CEO</p>
        </div>
      </a>

      <a href="https://en.wikipedia.org/wiki/Jesus" class="team-member" data-animate>
        <div>
          <img src="assets/images/team2.png" alt="Jesus">
          <h3>Jesus Christ</h3>
          <p>Head of Operations</p>
        </div>
      </a>

      <a href="https://en.wikipedia.org/wiki/The_Buddha" class="team-member" data-animate>
        <div>
          <img src="assets/images/team3.png" alt="Buddha">
          <h3>Gautam Buddha</h3>
          <p>Lead Developer</p>
        </div>
      </a>
    </div>
  </div>

  <footer>
    &copy; <?php echo date("Y"); ?> <a href="#">MeroPasal</a>. All rights reserved.
  </footer>

  <script>
    // Scroll animations
    const animatedItems = document.querySelectorAll("[data-animate]");
    const onScroll = () => {
      animatedItems.forEach(item => {
        const rect = item.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
          item.classList.add("visible");
        }
      });
    };
    window.addEventListener("scroll", onScroll);
    onScroll();

  </script>
</body>
</html>
