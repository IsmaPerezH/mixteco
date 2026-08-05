<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : "Acceso Administrador" ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@500;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    :root {
        --paper:        #F1E8D3;
        --paper-dark:   #E7DAB9;
        --ink:          #2A1F1A;
        --ink-soft:     #5A4A3E;
        --red:          #9B2226;
        --red-dark:     #6E1518;
        --turq:         #1F6F6B;
        --gold:         #C98A2B;
        --card-bg:      #FBF6EA;
    }
    * { margin:0; padding:0; box-sizing:border-box; }
    body {
        font-family: 'Inter', sans-serif;
        background: var(--paper);
        color: var(--ink);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    .login-container {
        width: 100%;
        max-width: 420px;
    }
    .login-card {
        background: var(--card-bg);
        border: 2px solid var(--ink);
        border-radius: 8px;
        padding: 2.5rem 2rem;
        box-shadow: 0 10px 30px rgba(42,31,26,0.12);
    }
    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .login-icon {
        width: 58px; height: 58px;
        background: rgba(155,34,38,0.1);
        color: var(--red);
        border: 2px solid var(--red);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
    }
    .login-title {
        font-family: 'Zilla Slab', serif;
        font-size: 1.75rem;
        color: var(--ink);
        margin-bottom: 0.4rem;
    }
    .login-subtitle {
        font-size: 0.88rem;
        color: var(--ink-soft);
        line-height: 1.4;
    }
    .login-alert {
        background: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
        padding: 0.75rem 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
        font-size: 0.88rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .login-form .form-group {
        margin-bottom: 1.2rem;
    }
    .login-form label {
        display: block;
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--ink);
        margin-bottom: 0.4rem;
    }
    .login-form input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--paper-dark);
        border-radius: 4px;
        background: var(--paper);
        color: var(--ink);
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }
    .login-form input:focus {
        outline: none;
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(155,34,38,0.1);
    }
    .btn-login {
        width: 100%;
        padding: 0.85rem;
        background: var(--red);
        color: var(--paper);
        border: none;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background 0.2s;
        margin-top: 0.5rem;
    }
    .btn-login:hover {
        background: var(--red-dark);
    }
    .login-footer {
        text-align: center;
        margin-top: 2rem;
        padding-top: 1.2rem;
        border-top: 1px solid var(--paper-dark);
    }
    .hint-text {
        font-size: 0.78rem;
        color: var(--ink-soft);
        margin-bottom: 0.8rem;
    }
    .back-link {
        font-size: 0.85rem;
        color: var(--turq);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .back-link:hover {
        color: var(--red);
    }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h1 class="login-title">Acceso Administrador</h1>
                <p class="login-subtitle">Gestión de contenidos para San Miguel El Grande</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="login-alert">
                    <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= $basePath ?>/admin/login" method="POST" class="login-form">
                <div class="form-group">
                    <label for="usuario"><i class="fas fa-user"></i> Usuario</label>
                    <input type="text" name="usuario" id="usuario" required placeholder="admin" autofocus>
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
                    <input type="password" name="password" id="password" required placeholder="••••••••">
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </button>
            </form>

            <div class="login-footer">
                <p class="hint-text"><i class="fas fa-info-circle"></i> Credenciales: <strong>admin</strong> / <strong>admin123</strong></p>
                <a href="<?= $basePath ?: '/' ?>" class="back-link"><i class="fas fa-arrow-left"></i> Volver al sitio público</a>
            </div>
        </div>
    </div>
</body>
</html>
