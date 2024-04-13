
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stat.css">
    <title>NavConnect</title>

    
</head>
<body>

    <div id="app">
        <section id="dashboard">
            <h1>Tableau de bord</h1>
            <ul style="display: flex; gap: 15px;">
                <li><a href="./index.php?controleur=admin&action=dashboard" >Général</a></li>
                <li><a href="./index.php?controleur=admin&action=formajouter">Ajouter date</a></li>
                <li><a href="./index.php?controleur=admin&action=formsupprimer">Supprimer date</a></li>
            </ul>
        </section>

        <section class="stats__container">
            <div class="stats__view">
                <div class="top">
                    <div class="svg">
                        <svg width="30" height="18" viewBox="0 0 30 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 0.341553C8.59038 0.341553 2.99414 3.82389 0 8.99982C2.99414 14.1757 8.59038 17.6581 15 17.6581C21.4095 17.6581 27.0058 14.1757 29.9999 8.99982C27.0058 3.82389 21.4095 0.341553 15 0.341553ZM20.7722 9.11524C20.7722 12.3031 18.1879 14.8875 15 14.8875C11.8121 14.8875 9.22778 12.3031 9.22778 9.11524C9.22778 5.92733 11.8121 3.34302 15 3.34302C18.1879 3.34302 20.7722 5.92733 20.7722 9.11524ZM18.0016 9.23089C18.0016 10.8248 16.7094 12.117 15.1154 12.117C13.5215 12.117 12.2293 10.8248 12.2293 9.23089C12.2293 9.08209 12.2406 8.93592 12.2623 8.79319C12.5459 8.99593 12.8932 9.11524 13.2683 9.11524C14.2247 9.11524 15 8.33994 15 7.38357C15 7.00848 14.8807 6.66124 14.6781 6.3777C14.8207 6.35602 14.9668 6.34478 15.1154 6.34478C16.7094 6.34478 18.0016 7.63693 18.0016 9.23089Z" fill="white"/></svg>
                    </div>
                </div>
                <div class="mid">
                    <span class="stat"><?= $Visites['visites'] ?></span>
                    <span>Visites ce mois-ci</span>
                </div>
            </div>

            <div class="stats__view">
                <div class="top">
                    <div class="svg">
                        <svg width="31" height="26" viewBox="0 0 31 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.75 6.98253C4.75 5.3866 5.38214 3.85605 6.50736 2.72756C7.63258 1.59907 9.1587 0.965088 10.75 0.965088C12.3413 0.965088 13.8674 1.59907 14.9926 2.72756C16.1179 3.85605 16.75 5.3866 16.75 6.98253C16.75 8.57845 16.1179 10.109 14.9926 11.2375C13.8674 12.366 12.3413 13 10.75 13C9.1587 13 7.63258 12.366 6.50736 11.2375C5.38214 10.109 4.75 8.57845 4.75 6.98253ZM0.25 23.6386C0.25 19.008 3.99063 15.2565 8.60781 15.2565H12.8922C17.5094 15.2565 21.25 19.008 21.25 23.6386C21.25 24.4096 20.6266 25.0349 19.8578 25.0349H1.64219C0.873438 25.0349 0.25 24.4096 0.25 23.6386ZM28.8109 25.0349H22.3469C22.6 24.5929 22.75 24.0805 22.75 23.5305V23.1544C22.75 20.3008 21.4797 17.7387 19.4781 16.0181C19.5906 16.0134 19.6984 16.0087 19.8109 16.0087H22.6891C26.8656 16.0087 30.25 19.4029 30.25 23.5916C30.25 24.3908 29.6031 25.0349 28.8109 25.0349ZM20.5 13C19.0469 13 17.7344 12.4076 16.7828 11.4533C17.7063 10.2028 18.25 8.65613 18.25 6.98253C18.25 5.72263 17.9406 4.53324 17.3922 3.48959C18.2641 2.85024 19.3375 2.46945 20.5 2.46945C23.4016 2.46945 25.75 4.82471 25.75 7.73471C25.75 10.6447 23.4016 13 20.5 13Z" fill="#0054FF"/></svg>
                    </div>
                </div>
                <div class="mid">
                    <span class="stat"><?= $Utilisateurs['users'] ?></span>
                    <span>Utilisateurs ce mois-ci</span>
                </div>
            </div>

            <div class="stats__view">
                <div class="top">
                    <div class="svg">
                        <svg width="31" height="20" viewBox="0 0 31 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.83333 0C1.99479 0 0.5 1.49479 0.5 3.33333V6.66667C0.5 7.125 0.885417 7.48438 1.31771 7.63542C2.29687 7.97396 3 8.90625 3 10C3 11.0938 2.29687 12.026 1.31771 12.3646C0.885417 12.5156 0.5 12.875 0.5 13.3333V16.6667C0.5 18.5052 1.99479 20 3.83333 20H27.1667C29.0052 20 30.5 18.5052 30.5 16.6667V13.3333C30.5 12.875 30.1146 12.5156 29.6823 12.3646C28.7031 12.026 28 11.0938 28 10C28 8.90625 28.7031 7.97396 29.6823 7.63542C30.1146 7.48438 30.5 7.125 30.5 6.66667V3.33333C30.5 1.49479 29.0052 0 27.1667 0H3.83333ZM7.16667 5.83333V14.1667C7.16667 14.625 7.54167 15 8 15H23C23.4583 15 23.8333 14.625 23.8333 14.1667V5.83333C23.8333 5.375 23.4583 5 23 5H8C7.54167 5 7.16667 5.375 7.16667 5.83333ZM5.5 5C5.5 4.07812 6.24479 3.33333 7.16667 3.33333H23.8333C24.7552 3.33333 25.5 4.07812 25.5 5V15C25.5 15.9219 24.7552 16.6667 23.8333 16.6667H7.16667C6.24479 16.6667 5.5 15.9219 5.5 15V5Z" fill="#0054FF"/></svg>
                    </div>
                </div>
                <div class="mid">
                    <span class="stat"><?= $Reservations['reservations'] ?></span>
                    <span>Réservations ce mois-ci</span>
                </div>
            </div>

            <div class="stats__view">
                <div class="top">
                    <div class="svg">
                        <svg width="31" height="28" viewBox="0 0 31 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.31991 10.6641C6.80126 9.3013 7.58267 8.01979 8.6829 6.92581C12.59 3.01874 18.9225 3.01874 22.8296 6.92581L23.8986 8.00103H21.7544C20.6479 8.00103 19.754 8.89497 19.754 10.0014C19.754 11.1079 20.6479 12.0019 21.7544 12.0019H28.7246H28.7496C29.8561 12.0019 30.75 11.1079 30.75 10.0014V2.99999C30.75 1.89351 29.8561 0.999574 28.7496 0.999574C27.6431 0.999574 26.7492 1.89351 26.7492 2.99999V5.20045L25.6552 4.10022C20.1853 -1.36967 11.321 -1.36967 5.85106 4.10022C4.32574 5.62554 3.22552 7.41966 2.55037 9.33881C2.18155 10.3828 2.73166 11.5205 3.76938 11.8893C4.8071 12.2582 5.95108 11.7081 6.31991 10.6703V10.6641ZM2.1878 16.084C1.87523 16.1777 1.57517 16.3465 1.33137 16.5966C1.08132 16.8466 0.912534 17.1467 0.825016 17.4718C0.806262 17.5468 0.787508 17.628 0.775005 17.7093C0.756251 17.8156 0.75 17.9218 0.75 18.0281V25.0046C0.75 26.1111 1.64394 27.005 2.75042 27.005C3.8569 27.005 4.75083 26.1111 4.75083 25.0046V22.8104L5.85106 23.9043C11.321 29.368 20.1853 29.368 25.6489 23.9043C27.1743 22.379 28.2807 20.5849 28.9559 18.672C29.3247 17.628 28.7746 16.4903 27.7369 16.1215C26.6992 15.7526 25.5552 16.3028 25.1863 17.3405C24.705 18.7033 23.9236 19.9848 22.8233 21.0788C18.9163 24.9858 12.5837 24.9858 8.67665 21.0788L8.6704 21.0725L7.60143 20.0035H9.75187C10.8584 20.0035 11.7523 19.1096 11.7523 18.0031C11.7523 16.8966 10.8584 16.0027 9.75187 16.0027H2.77542C2.6754 16.0027 2.57538 16.0089 2.47536 16.0215C2.37534 16.034 2.28157 16.0527 2.1878 16.084Z" fill="#0054FF"/></svg>
                    </div>
                </div>
                <div class="mid">
                    <span class="stat"><?= $Recurrence ?></span>
                    <span>Récurrence des Utilisateurs</span>
                </div>
            </div>
        </section>

        <section style="padding-top:0;">
            <form class="list__container" action="./admin/reservations.php" method="post">
                <h2>Trajets</h2>

                <div>
                    <table>
                        <tr style="position: sticky; top:0; background-color: #fff !important; z-index: 1;">
                            <th style="padding: 15px !important; width: 43px;"></th>
                            <th style="text-align: right;">ID</th>
                            <!-- <th style="text-align: left;">Statu</th> -->
                            <th style="text-align: left;">Date</th>
                            <th style="text-align: left;">Horaire Départ</th>
                            <th style="text-align: left;">Direction</th>
                            <th style="text-align: right;">Nombre Passagers</th>
                        </tr>
                        <?php
                            foreach ($lstTrajets as $trajet) {
                                // Date au format "yyyy-mm-dd"
                                $objDate = $objDateDAO->charger($trajet->getIdDate());
                                $date = $objDate->getDate();

                                // Transformer la date en format "j F Y" (1 Avril 2024)
                                $date_formattee = date("j ", strtotime($date)) . $mois[date('F', strtotime($date))] . date(" Y", strtotime($date));

                                $objHoraire = $objHoraireDAO->charger($trajet->getIdHoraire());

                                $direction = ($trajet->getIdDirection() == 1) ? "Anglet" : "Pau";
                        ?>
                        <tr>
                            <td style="padding: 15px !important; width: 43px;"><input type="radio" name="idTrajet" id="idTrajet" value="<?= $trajet->getIdTrajet() ?>" required></td>
                            <td style="text-align: right;"><?= $trajet->getIdTrajet() ?></td>
                            <!-- <td style="text-align: left;">Maintenu</td> -->
                            <td style="text-align: left;"><?= $date_formattee ?></td>
                            <td style="text-align: left;"><?= $objHoraire->getHeureDepart() ?></td>
                            <td style="text-align: left;"><?= $direction ?></td>
                            <td style="text-align: right;"><?= $objTrajetDAO->getNbReservations($trajet) ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
                <div class="popup">
                    <div class="left">
                        <span id="compteur">0</span>
                        <span>trajet sélectionné</span>
                    </div>
                    <div class="right">
                        
                        <input type="submit" value="Voir les réservations">
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script>
        // Récupérez tous les éléments input de type radio avec l'attribut name "idTrajet"
        const inputs = document.querySelectorAll('input[name="idTrajet"]');
        const resetButton = document.querySelector('input[type="reset"]');
        const span = document.getElementById('compteur');
    
        // Parcourez chaque input
        inputs.forEach(input => {
            // Ajoutez un écouteur d'événements "change"
            input.addEventListener('change', function() {
                // Supprimez la classe "active" de toutes les lignes du tableau
                const allRows = document.querySelectorAll('.list__container table tr');
                allRows.forEach(row => {
                    row.classList.remove('active');
                });
    
                // Récupérez la ligne parente tr de l'input
                const parentRow = this.closest('tr');
    
                // Si l'input est coché, ajoutez la classe "active" à la ligne parente
                if (this.checked) {
                    parentRow.classList.add('active');
                    span.innerHTML = "1";
                }
            });
        });
    
        // Parcourez chaque ligne du tableau
        const tableRows = document.querySelectorAll('.list__container table tr');
        tableRows.forEach(row => {
            // Ajoutez un écouteur d'événements "click"
            row.addEventListener('click', function() {
                // Récupérez l'input correspondant dans la même ligne
                const input = this.querySelector('input[name="idTrajet"]');
                // Vérifiez si l'input existe et simulez un clic sur celui-ci
                if (input) {
                    input.click();
                }
            });
        });
    
        // Ajoutez un écouteur d'événements "click" sur le bouton de reset
        resetButton.addEventListener('click', function() {
            // Désélectionnez tous les inputs
            inputs.forEach(input => {
                input.checked = false;
            });
    
            // Supprimez la classe "active" de toutes les lignes du tableau
            const allRows = document.querySelectorAll('.list__container table tr');
            allRows.forEach(row => {
                row.classList.remove('active');
                span.innerHTML = "0";
            });
        });
    </script>
    
</body>
</html>