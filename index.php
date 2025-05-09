<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaussures Jordan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Bebas Neue', sans-serif;
            background-image: url('images/nike_background.jpeg'); /* Assurez-vous que le chemin est correct */
            background-size: cover;
            background-repeat: no-repeat;
            color: #333;
            margin: 0;
            padding-bottom: 20px;
        }

        h1 {
            font-family: 'Bebas Neue', sans-serif;
            text-align: center;
            color: #fff;
            padding: 20px 0;
            background-color: rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }

        .carousel-container {
            display: flex;
            flex-direction: column; /* Organiser les éléments verticalement */
            align-items: center; /* Centrer horizontalement */
            margin-top: 100px; /* Ajouter une marge importante en haut */
            position: relative;
            max-height: 80vh; /* Empêcher de prendre toute la hauteur de l'écran */
        }

        .shoe-display {
            position: relative;
            text-align: center;
            margin: 20px; /* Ajouter un peu de marge autour de la chaussure */
            min-height: auto;
        }

        .shoe-item {
            position: absolute; /* Pour le fondu */
            top: 50%; /* Centre verticalement */
            left: 50%; /* Centre horizontalement */
            transform: translate(-50%, -50%); /* Ajuste pour le centrage précis */
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 15px;
            border-radius: 8px;
            text-align: center; /* Centre le texte à l'intérieur */
        }

        .shoe-item.active {
            opacity: 1;
        }

        .shoe-item img {
            max-width: 400px;
            height: auto;
            margin-bottom: 10px;
        }

        .shoe-item h3 {
            margin-top: 0;
            color: #000;
        }

        .shoe-item p {
            color: #555;
        }

        .prev-btn, .next-btn {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2em;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            z-index: 10;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .prev-btn {
            left: 10px;
        }

        .next-btn {
            right: 10px;
        }
    </style>
</head>
<body>
    <h1>Collection de Chaussures Jordan</h1>

    <div class="carousel-container">
        <button class="prev-btn">←</button>
        <div class="shoe-display">
        </div>
        <button class="next-btn">→</button>
    </div>

    <script>
        let shoesData = [];
        let currentIndex = 0;
        const shoeDisplay = document.querySelector('.shoe-display');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "portfolio_data";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connexion échouée : " . $conn->connect_error);
        }

        $sql = "SELECT modele, prix_achat, image_url FROM chaussures_jordan";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "shoesData = [";
            $first = true;
            while($row = $result->fetch_assoc()) {
                if (!$first) echo ",";
                echo JSON_encode($row);
                $first = false;
            }
            echo "];\n";
        } else {
            echo "console.log('Aucune chaussure trouvée.');\n";
        }
        $conn->close();
        ?>

        function displayShoe() {
            if (shoesData.length === 0) {
                shoeDisplay.innerHTML = "<p>Aucune chaussure à afficher.</p>";
                return;
            }

            shoeDisplay.innerHTML = `
                <div class="shoe-item active">
                    <img src="${shoesData[currentIndex].image_url}" alt="${shoesData[currentIndex].modele}">
                    <h3>${shoesData[currentIndex].modele}</h3>
                    <p>Prix : ${shoesData[currentIndex].prix_achat} €</p>
                </div>
            `;
        }

        function nextShoe() {
            currentIndex = (currentIndex + 1) % shoesData.length;
            displayShoe();
        }

        function prevShoe() {
            currentIndex = (currentIndex - 1 + shoesData.length) % shoesData.length;
            displayShoe();
        }

        // Initialiser l'affichage
        displayShoe();

        // Ajouter les écouteurs d'événements aux boutons
        nextBtn.addEventListener('click', nextShoe);
        prevBtn.addEventListener('click', prevShoe);
    </script>
</body>
</html>