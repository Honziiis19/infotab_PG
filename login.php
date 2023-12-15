<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Přihlášení</h1>
    <form method="POST">
        <input type="hidden" name="action" value="submited"/>
        <label for="email">Email:</label>
        <input id="email" type="email" name="email" required />
        <br/>
        <label for="heslo">Heslo:</label>
        <input id="heslo" type="password" name="heslo" required />
        <br/>
        <input type="submit" value="Přihlásit">
        <br/>
        <div>Registrace</div>
</body>
</html>