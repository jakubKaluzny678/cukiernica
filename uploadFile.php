<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Obsługa wylogowania
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

?>
<?php

// Konfiguracja bazy danych
$host = 'localhost';
$db = 'cukierniaUsers';
$user = 'root';
$pass = '';

// Połączenie z bazą
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
// Obsługa uploadu
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK && isset($_POST['category'])) {
    $originalName = $_FILES['photo']['name'];
    $tmpName = $_FILES['photo']['tmp_name'];
    $category = $_POST['category'];

    // Sprawdzenie MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $tmpName);
    finfo_close($finfo);

    // Obsługiwane typy
    $allowedMimes = ['image/jpeg', 'image/png'];
    if (!in_array($mime, $allowedMimes)) {
        echo "Dozwolone formaty to JPG i PNG.";
        exit;
    }

    // Stwórz nazwę docelową .webp
    $uniqueName = uniqid('photo_', true) . '.webp';
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $destination = $uploadDir . $uniqueName;

    // Wczytaj oryginalny obraz
    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($tmpName);
            break;
        case 'image/png':
            $image = imagecreatefrompng($tmpName);
            // Włącz przezroczystość PNG
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
            break;
        default:
            echo "Nieobsługiwany format pliku.";
            exit;
    }

    // Zapisz jako .webp
    if (imagewebp($image, $destination, 80)) {
        imagedestroy($image);

        // (Opcjonalnie) usuń oryginalny tymczasowy plik
        // unlink($tmpName);

        // Zapisz do bazy danych
        $stmt = $pdo->prepare("INSERT INTO photos (filename, original_name, category) VALUES (?, ?, ?)");
        $stmt->execute([$uniqueName, $originalName, $category]);

        echo "Plik został przekonwertowany do WebP i zapisany w kategorii: " . htmlspecialchars($category);
    } else {
        echo "Błąd podczas konwersji do WebP.";
    }
} else {
    echo "Nie wybrano pliku, kategorii lub wystąpił błąd.";
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administracyjny – dodawanie zdjęć</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f9f9f9; }
        form { margin-bottom: 30px; }
        img { width: 200px; margin: 10px; border-radius: 8px; object-fit: cover; }
        .gallery { display: flex; flex-wrap: wrap; gap: 10px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Panel dodawania zdjęć</h1>
    <p><a href="?logout=1">Wyloguj się</a></p>

    <?php if ($uploadMessage): ?>
        <p class="<?= $uploadSuccess ? 'success' : 'error' ?>"><?= $uploadMessage ?></p>
    <?php endif; ?>
    <form action="uploadFile.php" method="post" enctype="multipart/form-data">
    <input type="file" name="photo">
    <label for="category">Wybierz kategorię:</label>
    <select name="category" id="category" required>
        <option value="klasyczne">Klasyczne</option>
        <option value="okolicznosciowe">Okolicznościowe</option>
    </select>
    <button type="submit">Wyślij</button>
    </form>
<?php

// Funkcja usuwania:
function deletePhoto($pdo, $id) {
    $stmt = $pdo->prepare("SELECT filename FROM photos WHERE id = ?");
    $stmt->execute([$id]);
    $photo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($photo) {
        $filePath = __DIR__ . '/uploads/' . $photo['filename'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $stmt = $pdo->prepare("DELETE FROM photos WHERE id = ?");
        $stmt->execute([$id]);
        return true;
    }
    return false;
}

// Obsługa POST:
if (isset($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];
    if (deletePhoto($pdo, $id)) {
        echo "Zdjęcie zostało usunięte.";
    } else {
        echo "Błąd: zdjęcie nie istnieje.";
    }
}

// Pobranie zdjęć do wyświetlania:
$stmt = $pdo->query("SELECT * FROM photos ORDER BY uploaded_at DESC");
$photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Wyświetlanie zdjęć -->
<div class="galeria">
<?php foreach ($photos as $photo): ?>
    <div class="foto">
        <img src="uploads/<?php echo htmlspecialchars($photo['filename']); ?>" alt="">
        <form method="post" onsubmit="return confirm('Na pewno chcesz usunąć to zdjęcie?');">
            <input type="hidden" name="delete_id" value="<?php echo $photo['id']; ?>">
            <button type="submit">Usuń</button>
        </form>
    </div>
<?php endforeach; ?>
</div>

    <hr>
</div>

</body>
</html>
