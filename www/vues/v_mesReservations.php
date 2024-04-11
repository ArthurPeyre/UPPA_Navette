<section id="reservations">
    <h2>Mes réservations</h2>
    <div class="reservations__container">
        <?php
        if (!isset($_SESSION['Utilisateur'])) {
        ?>
        <p class="gray" style="text-align: center;">Connectez-vous pour voir vos réservations</p>
        <?php
        } else {
            $objUtilisateurDAO = new UtilisateurDAO();
            $objTrajetDAO = new TrajetDAO();
            $objDateDAO = new DateDAO();
            $objLieuDAO = new LieuDAO();
            $objHoraireDAO = new HoraireDAO();

            $tabReservations = $objUtilisateurDAO->getLesProchainesReservations($_SESSION['Utilisateur']);

            if (empty($tabReservations)) {
            ?>
            <p class="gray" style="text-align: center;">Aucun trajet réservé...</p>
            <?php
            } else {
                foreach ($tabReservations as $reservation) {

                    $objTrajet = $objTrajetDAO->charger($reservation->getIdTrajet());

                    $objDate = $objDateDAO->charger($objTrajet->getIdDate());

                    $objHoraire = $objHoraireDAO->charger($objTrajet->getIdHoraire());
                    
                    $timestamp = strtotime($objDate->getDate());
                    $date_formatee = date("d M Y", $timestamp);

                    $objLieuDepart = $objLieuDAO->charger($reservation->getIdLieuDepart());

                    $objLieuArrivee = $objLieuDAO->charger($reservation->getIdLieuArrivee());

                    $nbReservations = $objTrajetDAO->getNbReservations($objTrajet);
        ?>
        <div class="reservation">
            <div class="top">
                <span><?= $date_formatee ?></span>
                <div style="display: flex; gap: 15px;">
                    <span><?php include('res/images/people.svg'); ?> <?= $nbReservations ?></span>
                    <a href="./index.php?controleur=gererReservations&action=annulation&id_trajet=<?= $objTrajet->getIdTrajet() ?>" style="color: #f00;">Annuler</a>
                </div>
            </div>
            <hr>
            <div class="mid">
                <div>
                    <span class="bold"><?= $objHoraire->getHeureDepart() ?></span>
                    <span class="gray">Départ</span>
                </div>
                <div>
                    <div class="row">
                        <svg width="19" height="15" viewBox="0 0 19 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.10663 3.04688V5.625H4.91281V2.8125H2.34047C2.21186 2.8125 2.10663 2.91797 2.10663 3.04688ZM16.196 5.625L13.8312 2.8125H11.4606V5.625H16.196ZM9.58977 5.625V2.8125H6.78359V5.625H9.58977ZM17.5406 11.25H17.0729C17.0729 12.8027 15.816 14.0625 14.2667 14.0625C12.7175 14.0625 11.4606 12.8027 11.4606 11.25H7.71899C7.71899 12.8027 6.46205 14.0625 4.91281 14.0625C3.36356 14.0625 2.10663 12.8027 2.10663 11.25H1.63893C0.864307 11.25 0.23584 10.6201 0.23584 9.84375V3.04688C0.23584 1.88086 1.17708 0.9375 2.34047 0.9375H5.8482H10.5252H13.8312C14.3837 0.9375 14.9069 1.18066 15.2635 1.60547L18.5052 5.46387C18.7888 5.80078 18.9437 6.22852 18.9437 6.6709V9.84375C18.9437 10.6201 18.3152 11.25 17.5406 11.25ZM15.6698 11.25C15.6698 10.877 15.522 10.5194 15.2589 10.2556C14.9957 9.99191 14.6389 9.84375 14.2667 9.84375C13.8946 9.84375 13.5377 9.99191 13.2746 10.2556C13.0115 10.5194 12.8636 10.877 12.8636 11.25C12.8636 11.623 13.0115 11.9806 13.2746 12.2444C13.5377 12.5081 13.8946 12.6562 14.2667 12.6562C14.6389 12.6562 14.9957 12.5081 15.2589 12.2444C15.522 11.9806 15.6698 11.623 15.6698 11.25ZM4.91281 12.6562C5.28493 12.6562 5.64181 12.5081 5.90494 12.2444C6.16807 11.9806 6.3159 11.623 6.3159 11.25C6.3159 10.877 6.16807 10.5194 5.90494 10.2556C5.64181 9.99191 5.28493 9.84375 4.91281 9.84375C4.54068 9.84375 4.1838 9.99191 3.92067 10.2556C3.65754 10.5194 3.50972 10.877 3.50972 11.25C3.50972 11.623 3.65754 11.9806 3.92067 12.2444C4.1838 12.5081 4.54068 12.6562 4.91281 12.6562Z" fill="black"/></svg>
                    </div>
                    <span class="gray">1 h 30 min</span>
                </div>
                <div>
                    <span class="bold"><?= $objHoraire->getHeureArrivee() ?></span>
                    <span class="gray">Arrivée</span>
                </div>
            </div>
            <hr>
            <div class="btm">
                <div>
                    <span><?= $objLieuDepart->getVille() ?></span>
                    <span class="gray"><?= $objLieuDepart->getLieu() ?></span>
                </div>
                <div>
                    <span><?= $objLieuArrivee->getVille() ?></span>
                    <span class="gray"><?= $objLieuArrivee->getLieu() ?></span>
                </div>
            </div>
        </div>
        <?php
                }
            }
        }
        ?>
    </div>
</section>