<?php
    //On démarre une nouvelle session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Description des codes d'ereurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 900px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 500px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <?php
        include './navbar.php';
    ?>
    
    <div class="wrapper">
        <div class="container-fluid">
        </br>
        </br>
        <table class="table table-bordered table-striped bg-light border shadow mb-5 bg-white rounded">
            <thead>
            <tr>
                <th scope="col">CODE</th>
                <th scope="col">QU’EST-CE QU’IL SIGNIFIE</th>
                <th scope="col">QUOI FAIRE</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">101</th>
                    <td>Le serveur est incapable de se connecter.</td>
                    <td>Essayez de changer le nom du serveur (peut-être mal orthographié) ou le port de connexion.</td>
                </tr>
                <tr>
                    <th scope="row">111</th>
                    <td>Connexion refusée ou l’impossibilité d’ouvrir un flux SMTP.</td>
                    <td>Ce genre d’erreurs se réfère normalement à un problème de connexion avec le serveur SMTP à distance, causé par un firewall ou par des domaines mal orthographiés. Vérifiez toutes les configurations ou demandez à votre fournisseur.</td>
                </tr>
                <tr>
                    <th scope="row">211</th>
                    <td>Message d’état du système ou réponse d’aide.</td>
                    <td>Il est livré avec plus d’informations sur le serveur.</td>
                </tr>
                <tr>
                    <th scope="row">214</th>
                    <td>Une réponse à la commande HELP.</td>
                    <td>Il contient des informations sur votre serveur, en pointant normalement à une page FAQ.</td>
                </tr>
                <tr>
                    <th scope="row">220</th>
                    <td>Le serveur est prêt.</td>
                    <td>C’est juste un message de bienvenue. Soyez heureux que tout fonctionne (pour l’instant)!</td>
                </tr>
                <tr>
                    <th scope="row">221</th>
                    <td>Le serveur ferme son canal de transmission. Il peut est livré avec des messages tels que « Goodbye » ou « Closing connection ».</td>
                    <td>La session de mailing va se terminer, ce qui signifie simplement que tous les messages ont été livrés.</td>
                </tr>
                <tr>
                    <th scope="row">250</th>
                    <td>Son message à côté typique est « Requested mail action okay completed »: ce qui signifie que le serveur a transmis un message.</td>
                    <td>Le contraire exact d’une erreur: tout a fonctionné et votre email a été livré.</td>
                </tr>
                <tr>
                    <th scope="row">251</th>
                    <td>« User not local will forward »: le compte du destinataire n’est pas présent sur le serveur, donc il sera relayé à un autre.</td>
                    <td>C’est une normale action de transfert.</td>
                </tr>
                <tr>
                    <th scope="row">252</th>
                    <td>Le serveur ne peut pas vérifier l’utilisateur, mais il va essayer de transmettre le message de toute façon.</td>
                    <td>L’adresse email du destinataire est valide, mais pas vérifiable. Normalement, le serveur transfère le message vers un autre serveur qui sera en mesure de le vérifier.</td>
                </tr>
                <tr>
                    <th scope="row">354</th>
                    <td>Le message peut être très cryptique (« Start mail input end <CRLF>.<CRLF> »). C’est la réponse typique à la commande DATA.</td>
                    <td>Le serveur a reçu les détails « De » et « A » de l’email, et est prêt à faire passer le corps du message.</td>
                </tr>
                <tr>
                    <th scope="row">420</th>
                    <td>« Timeout connection problem »: il y a eu des problèmes lors du transfert des messages.</td>
                    <td>Ce message d’erreur est produite uniquement par les serveurs GroupWise. Soit votre email a été bloqué par le firewall du destinataire, ou il y a un problème de hardware. Vérifiez chez votre fournisseur.</td>
                </tr>
                <tr>
                    <th scope="row">421</th>
                    <td>Le service est indisponible en raison d’un problème de connexion: il peut se référer à un dépassement de la limite de connexions simultanées, ou à un problème temporaire plus général.</td>
                    <td>Le serveur (le vôtre ou celui du destinataire) n’est pas disponible pour le moment, de sorte que l’envoi sera essayé plus tard.</td>
                </tr>
                <tr>
                    <th scope="row">422</th>
                    <td>La boîte du destinataire a dépassé sa limite de stockage.</td>
                    <td>Le mieux est de contacter l’utilisateur à travers d’un autre canal pour l’alerter et demander de créer de l’espace de libre dans sa boîte.</td>
                </tr>
                <tr>
                    <th scope="row">431</th>
                    <td>Pas assez d’espace sur le disque, ou un « out of memory » condition due à une surcharge du fichier.</td>
                    <td>Vous devriez essayer à nouveau d’envoyer plus petits ensembles d’emails au lieu d’un grand envoi unique.</td>
                </tr>
                <tr>
                    <th scope="row">432</th>
                    <td>« The recipient’s Exchange Server incoming mail queue has been stopped ».</td>
                    <td>C’est le code d’erreur SMTP de Microsoft Exchange. Vous devriez communiquer avec lui pour obtenir de plus amples renseignements: généralement il est dû à un problème de connexion.</td>
                </tr>
                <tr>
                    <th scope="row">441</th>
                    <td>Le serveur du destinataire ne répond pas.</td>
                    <td>Il y a un problème avec le serveur entrant de l’utilisateur: le vôtre réessayera de le contacter.</td>
                </tr>
                <tr>
                    <th scope="row">442</th>
                    <td>La connexion a été interrompue pendant la transmission.</td>
                    <td>Un problème de connexion réseau typique, en raison de votre routeur: vérifiez immédiatement.</td>
                </tr>
                <tr>
                    <th scope="row">446</th>
                    <td>« The maximum hop count was exceeded for the message: an internal loop has occurred.</td>
                    <td>Demandez à votre fournisseur SMTP pour vérifier ce qui s’est passé.</td>
                </tr>
                <tr>
                    <th scope="row">447</th>
                    <td>Votre message sortant a expiré en raison de problèmes concernant le serveur entrant.</td>
                    <td>Cela se produit généralement lorsque vous avez dépassé la limite de votre serveur de nombre de destinataires pour un message. Essayez d’envoyer à nouveau en segmentant la liste dans des parts plus petites.</td>
                </tr>
                <tr>
                    <th scope="row">449</th>
                    <td>Une erreur de routing.</td>
                    <td>Comme l’erreur 432, il est relatif seulement à Microsoft Exchange. Utilisez WinRoute.</td>
                </tr>
                <tr>
                    <th scope="row">450</th>
                    <td>« Requested action not taken – The user’s mailbox is unavailable ».  La boîte a été corrompue ou placée sur un serveur pas en ligne, ou votre email n’a pas été accepté pour des problèmes d’IP ou de blacklisting.</td>
                    <td>Le serveur va réessayer d’envoyer le message de nouveau, après un certain temps. En tout cas, vérifier qu’il travaille sur une adresse IP fiable.</td>
                </tr>
                <tr>
                    <th scope="row">451</th>
                    <td>« Requested action aborted – Local error in processing ». Le serveur de votre fournisseur d’accès Internet ou le serveur qui a obtenu un premier relais du vôtre a rencontré un problème de connexion.</td>
                    <td>C’est normalement une erreur passagère due à une surcharge de messages, mais elle peut se référer aussi à un rejet en raison d’un filtre antispam. Si elle ne cesse pas de se répéter, demandez à votre fournisseur SMTP de vérifier la situation.</td>
                </tr>
                <tr>
                    <th scope="row">452</th>
                    <td>Trop de courriels envoyés ou trop de destinataires: Plus généralement, une limite de stockage du serveur dépassées.</td>
                    <td>Encore une fois, la cause typique est une surcharge de message. Généralement, la prochaine tentative va réussir: en cas de problèmes sur votre serveur, il viendra avec un message de côté comme « Out of memory ».</td>
                </tr>
                <tr>
                    <th scope="row">471</th>
                    <td>Une erreur de votre serveur de messagerie, souvent en raison d’un problème de filtre antispam local.</td>
                    <td>Contactez votre fournisseur de service SMTP pour corriger la situation.</td>
                </tr>
                <tr>
                    <th scope="row">500</th>
                    <td>Une erreur de syntaxe: le serveur n’a pas pu reconnaître la commande.</td>
                    <td>Il peut être causé par une mauvaise interaction entre le serveur avec votre firewall ou antivirus. Vérifiez soigneusement les instructions pour le résoudre.</td>
                </tr>
                <tr>
                    <th scope="row">501</th>
                    <td>Une autre erreur de syntaxe, pas dans la commande, mais dans ses paramètres ou les arguments.</td>
                    <td>Dans la plupart des fois il est dû à une adresse e-mail valide, mais il peut également être associée à des problèmes de connexion (ou encore, une question concernant vos paramètres d’antivirus).</td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                </tr>
                <tr>
                    <th scope="row">550</th>
                    <td>Il définit habituellement une adresse email inexistante sur le côté à distance.</td>
                    <td>Bien qu’il puisse être retourné aussi par le firewall du destinataire (ou lorsque le serveur entrant est en panne), la grande majorité des erreurs 550 simplement dit que l’adresse email du destinataire n’existe pas. Vous devez contacter le destinataire autrement et obtenir la bonne adresse</td>
                </tr>
                <tr>
                    <th scope="row">551</th>
                    <td>« User not local or invalid address – Relay denied ». Si soit votre adresse et celui du destinataire ne sont pas localement hébergé par le serveur, un relais peut être interrompu.</td>
                    <td>C’est une stratégie (pas très intelligente) pour éviter le spamming. Vous devriez communiquer avec votre fournisseur de services Internet et demandez-lui de vous étiqueter comme un expéditeur agréé. Bien sûr, avec un fournisseur de SMTP professionnel comme turboSMTP vous ne devrez jamais fair face à ce problème.</td>
                </tr>
                <tr>
                    <th scope="row">552</th>
                    <td>« Requested mail actions aborted – Exceeded storage allocation »: tout simplement, la boîte du destinataire a dépassé ses limites.</td>
                    <td>Essayez d’envoyer un message plus léger: cette erreur arrive généralement quand vous expédez des courriels avec des pièces jointes grandes.</td>
                </tr>
                <tr>
                    <th scope="row">553</th>
                    <td>« Requested action not taken – Mailbox name invalid ». Autrement dit, il y a une adresse email incorrecte dans la ligne des destinataires.</td>
                    <td>Vérifiez toutes les adresses dans le champs TO, CC et CCI. Il devrait y avoir une erreur ou une faute d’orthographe quelque part.</td>
                </tr>
                <tr>
                    <th scope="row">554</th>
                    <td>Cela signifie que l’opération a échoué. C’est une erreur permanente et le serveur ne va pas essayer d’envoyer le message une autre fois.</td>
                    <td>En général, le serveur entrant pense que votre email est spam ou une adresse IP a été blacklistée. Vérifiez soigneusement si vous vous retrouviez dans certaines listes de spam, ou comptez sur un service SMTP professionnel comme turboSMTP qui annule ce problème.</td>
                </tr>
                
                
            </tbody>
        </table>  
        </div>
    </div>
    
    
</body>
<footer>
    <?php
        include './footer.php';
    ?>                
</footer>
</html>