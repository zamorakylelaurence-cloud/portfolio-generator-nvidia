
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'MyPortfolio')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ==============================
           CSS VARIABLES
        ============================== */
        :root {
            --bg: #101010;
            --surface: #1F1F1F;
            --ink: #F5F5F5;
            --muted: #B0B0B0;
            --line: #383838;
            --primary: #76B900;
            --primary2: #8BCF20;
            --danger: #EF4444;
            --radius: 18px;
        }

        /* ==============================
           GLOBAL STYLES
        ============================== */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font: 16px/1.6 Inter, ui-sans-serif, system-ui,
                -apple-system, "Segoe UI", sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        h1,
        h2,
        h3,
        p {
            margin-top: 0;
        }

        h1 {
            font-size: clamp(2.1rem, 5vw, 3.8rem);
            line-height: 1.05;
            letter-spacing: -.055em;
        }

        h2 {
            letter-spacing: -.03em;
        }

        /* ==============================
           NAVIGATION
        ============================== */
        .nav {
            background: #101010;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .nav-inner {
            max-width: 1120px;
            margin: auto;
            padding: 14px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .brand {
            font-size: 1.2rem;
            font-weight: 850;
            letter-spacing: -.04em;
        }

        .brand span {
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 18px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ==============================
           BUTTONS
        ============================== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 11px;
            padding: 11px 17px;
            background: var(--primary);
            color: #101010;
            font-weight: 750;
            cursor: pointer;
            font-size: .95rem;
        }

        .btn:hover {
            filter: brightness(.96);
        }

        .btn.secondary {
            background: #303030;
            color: #F5F5F5;
        }

        .btn.danger {
            background: #3A1919;
            color: #FF9A9A;
        }

        .btn.outline {
            background: #101010;
            color: var(--ink);
            border: 1px solid var(--line);
        }

        .btn.small {
            padding: 7px 11px;
            font-size: .85rem;
        }

        /* ==============================
           LAYOUT AND CONTAINERS
        ============================== */
        .container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 32px 22px 64px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        /* ==============================
           CARDS AND TEXT
        ============================== */
        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 8px 28px #15204708;
        }

        .muted {
            color: var(--muted);
        }

        .eyebrow {
            text-transform: uppercase;
            letter-spacing: .13em;
            font-size: .76rem;
            font-weight: 800;
            color: var(--primary);
        }

        .pill {
            display: inline-block;
            background: #26380E;
            color: #A5E64A;
            padding: 4px 10px;
            border-radius: 99px;
            font-size: .8rem;
            font-weight: 750;
        }

        /* ==============================
           FORMS
        ============================== */
        .field {
            margin-bottom: 17px;
        }

        .field label {
            display: block;
            font-weight: 750;
            font-size: .9rem;
            margin-bottom: 6px;
        }

        .field input,
        .field textarea,
        .field select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d6dbe6;
            border-radius: 10px;
            background: #101010;
            color: var(--ink);
            font: inherit;
        }

        .field textarea {
            min-height: 105px;
            resize: vertical;
        }

        .field small {
            display: block;
            color: var(--muted);
            margin-top: 5px;
        }

        .error {
            color: #FF9A9A;
            font-size: .85rem;
        }

        /* ==============================
           ALERT MESSAGES
        ============================== */
        .alert {
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 18px;
            background: #17210D;
            color: #A5E64A;
        }

        /* ==============================
           HOME PAGE HERO
        ============================== */
        .hero {
            padding: 54px 0 36px;
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 32px;
            align-items: center;
        }

        .hero-panel {
            background: linear-gradient(
                140deg,
                #101010,
                #76B900 65%,
                #8BCF20
            );
            color: white;
            border-radius: 26px;
            padding: 28px;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* ==============================
           PORTFOLIO TEMPLATE SELECTION
        ============================== */
        .template-card {
            border: 2px solid var(--line);
            border-radius: 18px;
            padding: 18px;
            background: white;
        }

        .template-card input {
            accent-color: var(--primary);
        }

        .template-card:has(input:checked) {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px #76B9001a;
        }

        .mock {
            height: 125px;
            border-radius: 12px;
            margin: 12px 0;
            background: #171717;
            padding: 14px;
            overflow: hidden;
        }

        .mock.simple {
            border-top: 5px solid #101010;
        }

        .mock.modern {
            background: linear-gradient(135deg, #101010, #26380E);
            color: white;
        }

        .mock.creative {
            background: #26380E;
            transform: rotate(-1deg);
            color: #252525;
        }

        /* ==============================
           GENERATED PORTFOLIO
        ============================== */
        .profile-img {
            width: 124px;
            height: 124px;
            border-radius: 50%;
            object-fit: cover;
            background: #303030;
        }

        .portfolio {
            max-width: 900px;
            margin: 0 auto;
            background: #101010;
            border: 1px solid var(--line);
            border-radius: 22px;
            overflow: hidden;
        }

        .portfolio-head {
            padding: 38px;
        }

        .portfolio-body {
            padding: 0 38px 38px;
        }

        /* Simple template */
        .portfolio .simple .portfolio-head {
            border-bottom: 1px solid var(--line);
        }

        /* Modern template */
        .portfolio .modern {
            background: #111827;
            color: #f9fafb;
            border: 0;
        }

        .portfolio .modern .portfolio-head {
            background: linear-gradient(130deg, #1F1F1F, #76B900);
            color: white;
        }

        .portfolio .modern .muted {
            color: #c6c9d5;
        }

        .portfolio .modern .section-block {
            background: #1F1F1F;
            border-color: #374151;
        }

        /* Creative template */
        .portfolio .creative {
            border: 0;
            background: #171717;
        }

        .portfolio .creative .portfolio-head {
            background: #76B900;
            border-bottom: 5px solid #181818;
        }

        .portfolio .creative h1 {
            font-size: clamp(2.5rem, 7vw, 5rem);
            text-transform: uppercase;
        }

        /* Portfolio sections */
        .section-block {
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 17px;
            margin: 16px 0;
            overflow-wrap: anywhere;
        }

        .item-list {
            padding-left: 20px;
        }

        .item-list li {
            margin: 5px 0;
        }

        /* ==============================
           FOOTER
        ============================== */
        .footer {
            padding-top: 25px;
            color: var(--muted);
            font-size: .85rem;
            text-align: center;
        }

        /* ==============================
           RESPONSIVE DESIGN
        ============================== */
        @media (max-width: 760px) {
            .grid,
            .two-col,
            .hero {
                grid-template-columns: 1fr;
            }

            .hero {
                padding-top: 30px;
            }

            .nav-inner {
                align-items: flex-start;
                flex-direction: column;
            }

            .portfolio-head,
            .portfolio-body {
                padding: 23px;
            }

            .container {
                padding: 24px 15px 45px;
            }

            .hero-panel {
                min-height: 220px;
            }
        }

        /* NVIDIA-inspired dark variant overrides */
        :root { color-scheme: dark; }
        body { background: #101010; color: #F5F5F5; }
        .nav { background: #101010; border-bottom-color: #303030; }
        .brand span, .eyebrow { color: #76B900; }
        .btn { background: #76B900; color: #101010; }
        .btn:hover { background: #8BCF20; color: #101010; }
        .btn.secondary { background: #303030; color: #F5F5F5; }
        .btn.danger { background: #3A1919; color: #FF9A9A; }
        .btn.outline { background: #1F1F1F; color: #F5F5F5; border: 1px solid #484848; }
        .card, .template-card { background: #1F1F1F; border-color: #383838; color: #F5F5F5; }
        .pill { background: #26380E; color: #A5E64A; }
        .field input, .field textarea, .field select { background: #171717; color: #F5F5F5; border-color: #484848; }
        .field input::placeholder, .field textarea::placeholder { color: #929292; }
        .field input:focus, .field textarea:focus, .field select:focus { border-color: #76B900; outline: 2px solid #76B900; }
        .alert { background: #17210D; color: #A5E64A; }
        .template-card:has(input:checked) { border-color: #76B900; box-shadow: 0 0 0 3px #76B90026; }
        .mock { background: #171717; color: #F5F5F5; border-color: #383838; }
        .mock.simple { background: #171717; color: #F5F5F5; }
        .mock.modern { background: linear-gradient(135deg, #101010, #26380E); color: #F5F5F5; }
        .mock.creative { background: linear-gradient(135deg, #1F1F1F, #26380E); color: #A5E64A; }
        .footer { color: #929292; }
        .profile-img { border: 2px solid #76B900; }
        @media print { body { background: #fff !important; color: #111 !important; } }
    </style>
</head>

<body>

    <!-- ==============================
         NAVIGATION BAR
    ============================== -->
    <header class="nav">
        <div class="nav-inner">

            <a class="brand" href="{{ route('home') }}">
                MyPortfolio
            </a>

            <nav class="nav-links">
    <a href="{{ route('home') }}">Home</a>

    @auth
        <a href="{{ route('portfolios.index') }}">
            Manage Portfolios
        </a>

        <a class="btn small" href="{{ route('portfolios.create') }}">
            + Create portfolio
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn small secondary">
                Log out
            </button>
        </form>
    @else
        <a href="{{ route('login') }}">Log in</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>

        </div>
    </header>

    <!-- ==============================
         MAIN CONTENT
    ============================== -->
    <main class="container">

        <!-- Success message -->
        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Validation errors -->
        @if ($errors->any())
            <div
                class="alert"
                style="background: #3A1919; color: #9f2222;"
            >
                <strong>Please check the form:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page-specific content -->
        @yield('content')

        <!-- Footer -->
        <div class="footer">
            MyPortfolio · Build a portfolio that represents you.
        </div>

    </main>

</body>
</html>

