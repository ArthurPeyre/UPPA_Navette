<form action="./index.php?controleur=admin&action=ajouter" method="post" >
<section id="dashboard">
            
            <ul style="display: flex; gap: 15px;">
                <li><a href="./index.php?controleur=admin&action=dashboard" >Général</a></li>
                <li><a href="./index.php?controleur=admin&action=formajouter">Ajouter date</a></li>
                <li><a href="./index.php?controleur=admin&action=formsupprimer">Supprimer date</a></li>
            </ul>
        </section>
    <h2>Ajouter Date</h2>

    <label for="date">
        Date <br/>
        <input type="date" name="txtDate" id="" required>
    </label>

    

    <input type="submit" name="formAjouter" value="Ajouter Date">

    
</form>