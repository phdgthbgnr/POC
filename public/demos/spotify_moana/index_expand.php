<?php
/*
session_start();

$dateT = time();
$tokens = md5(rand(1000,9999)); //you can use any encryption
$_SESSION['token'] = array('id' => $tokens, 'curtime' => $dateT ); //store it as session variable
*/

header('X-Frame-Options: DENY');

$lang = 'us';
$rep = 'us';
$cdl = 'us';
$moana = 0; // album moana pas dispo

$host = $_SERVER['HTTP_HOST'];

switch ($host){
    case 'moana-spotify.com':
    case 'www.moana-spotify.com':
        header('Location: http://moana-spotify.com/moana.html');
    break;
    case 'vaiana-spotify.com':
    case 'www.vaiana-spotify.com':
        header('Location: http://vaiana-spotify.com/vaiana.html');
    break;
}

$trad = array(
    'us' => array(
        'title'    => 'moana-spotify',
        'descr'    => 'come aboard and take a musical journey with moana',
        'keyw'     => 'disney, moana, animation movies, interactive map, songs, spotify',
        'big'      => 'moana',
        'image'    => 'Images',
        'video'    => 'Videos',
        'plst'     => 'Playlists',
        'travel'   => 'Travelling...',
        'soon'     => 'Return on November 18 to discover the music from Moana',
        'turn'     => 'Turn your screen please'
    ),
    'fr' => array(
        'title'    => 'vaiana-spotify',
        'descr'    => 'Monte à bord et pars à l\'aventure avec Vaiana !',
        'keyw'     => 'Déplace-toi sur la carte interactive et retrouve les soundtracks de tes films d\'animation Disney préférés !',
        'big'      => 'vaiana',
        'image'    => 'Images',
        'video'    => 'Videos',
        'plst'     => 'Playlists',
        'travel'   => 'Voyage en cours...',
        'soon'     => 'Reviens le 18 novembre pour découvrir la soundtrack de Vaiana',
        'turn'     => 'Tournez votre écran s\'il vous plait'
    ),
    'de' => array(
        'title'    => 'vaiana-spotify',
        'descr'    => 'Komm an Bord und erlebe die musikalische Reise von Vaiana',
        'keyw'     => 'Entdecke dank der interaktiven Karte die Lieder deiner Lieblings Walt Disney Filme',
        'big'      => 'vaiana',
        'image'    => 'Images',
        'video'    => 'Videos',
        'plst'     => 'Playlists',
        'travel'   => 'Reisen...',
        'soon'     => 'Ab 18. November findest du hier den Vaiana Soundtrack',
        'turn'     => 'Bildschirm bitte drehen'
    ),
    'nl' => array(
        'title'    => 'vaiana-spotify',
        'descr'    => 'Kom aan boord en beleef een muzikaal avontuur met Vaiana',
        'keyw'     => 'Ontdek op de interactieve kaart de liedjes van je favoriete Walt Disney films',
        'big'      => 'vaiana',
        'image'    => 'Images',
        'video'    => 'Videos',
        'plst'     => 'Playlists',
        'travel'   => 'Laden...',
        'soon'     => 'Keer terug op 18 november en ontdek de Vaiana Soundtrack',
        'turn'     => 'Draai je scherm'
    ),
    'es' => array(
        'title'    => 'moana-spotify',
        'descr'    => 'Sube a bordo de un viaje musical con Vaiana',
        'keyw'     => 'Navega en el mapa interactivo y escucha la música de tu película favorita de Disney',
        'big'      => 'vaiana',
        'image'    => 'Images',
        'video'    => 'Videos',
        'plst'     => 'Playlists',
        'travel'   => 'Viajando...',
        'soon'     => 'Vuelve el 18 de noviembre oara descubrir la música de Vaiana',
        'turn'     => 'Gira tu pantalla por favor'
    ),
    'it' => array(
        'title'    => 'oceania-spotify',
        'descr'    => 'Sali a bordo e scopri la musica con Oceania',
        'keyw'     => 'Navifga la mappa intereattiva e ascolta la colonna sonora dei tuoi film Disney preferiti',
        'big'      => 'vaiana',
        'image'    => 'Images',
        'video'    => 'Videos',
        'plst'     => 'Playlists',
        'travel'   => 'Viaggiando...',
        'soon'     => 'Torna a trovarci il 22 dicembre e scopri le canzoni di Oceania',
        'turn'     => 'Ruota lo schermo'
    ),
    'prt' => array(
        'title'    => 'vaiana-spotify',
        'descr'    => 'Suba a bordo para uma aventura musical com Vaiana',
        'keyw'     => 'Navegue pelo mapa interativo e ouça as músicas dos seus filmes favoritos Walt Disney.',
        'big'      => 'vaiana',
        'image'    => 'Images',
        'video'    => 'Videos',
        'plst'     => 'Playlists',
        'travel'   => 'Viajando...',
        'soon'     => 'Retorne dia 18 de novembro para descobrir as músicas de Moana',
        'turn'     => 'Vire a tela por favor'
    ),
    'bra' => array(
        'title'    => 'moana-spotify',
        'descr'    => 'Suba a bordo para uma aventura musical com Moana',
        'keyw'     => 'Navegue pelo mapa interativo e ouça as suas músicas favoritas dos filmes Walt Disney.',
        'big'      => 'moana',
        'image'    => 'Images',
        'video'    => 'Videos',
        'plst'     => 'Playlists',
        'travel'   => 'Viajando...',
        'soon'     => 'Retorne dia 18 de novembro para descobrir as músicas de Moana',
        'turn'     => 'Vire a tela por favor'
    )
);

//ie = uk

$trad['befr'] = $trad['fr'];
$trad['benl'] = $trad['nl'];

// uk = us = au = ca = mys = idn = phl = sgp
$trad['nz'] = $trad['ie'] = $trad['uk'] = $trad['ca'] = $trad['au'] = $trad['mys'] = $trad['idn'] = $trad['phl'] = $trad['sgp'] = $trad['us'];

//es = cl = mx = co = arg = per
$trad['cl'] = $trad['mx'] = $trad['co'] = $trad['arg'] = $trad['per'] = $trad['es'];
$trad['es']['title'] = 'vaiana-spotify';

//$trad['bra'] = $trad['prt'];

//
$albums = array(
    'us' => array(
        'aladdin'               => '29EiOQJnxWlX5nVOWQpu3u',
        'cinderella'            => '6vFrF3FIZ1BdEG4aw4jxvg',
        'frozen'                => '7lZs5r4oQV2nutddffLrg0',
        'mulan'                 => '3Ohs7Jo6GM6mydUOL0m5aC',
        'peterpan'              => '1tCVqfTbVWmXFXx0HmGkob',
        'pinocchio'             => '5zsAzctyWGNrchLWXFvKgz',
        'pocahontas'            => '7L6kEZVkWh7OEI71b1JHZd',
        'frog'                  => '6zgvBxOmfWxrQi4Jxxki0P',
        'tangled'               => '1l0aFrH24oPrQSqGtfeFyE',
        'junglebook'            => '7zdZNXoapFcOW663zgLdOE',
        'lionking'              => '3YA5DdB3wSz4pdfEXoMyRd',
        'bighero6'              => '72FOmF0bBxV9zPY1463mmM',
        'mermaid'               => '3H75XHlF94Eo78ICk5GcZB',
        'moana'                 => '6pZj4nvx6lV3ulIK3BSjvs', // OK
        'baymax'                => '72FOmF0bBxV9zPY1463mmM'
    ),
    'uk' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2',
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL',
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP',
        'mulan'                 => '4z7cSxC9GqPVh9Nz579wel',
        'peterpan'              => '2zl74AAxR2uagYVy7660bQ',
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK',
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ',
        'frog'                  => '1gq7uhfNW4QMeRr9msV68P',
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2',
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK',
        'lionking'              => '77lVNxDvXAYThJzrCXlbln',
        'bighero6'              => '2hUbtimwQNZsWd162386Jj',
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj',
        'moana'                 => '5thnqtTNTuB2VhBLu58uLh', // OK
        'baymax'                => '2hUbtimwQNZsWd162386Jj'
    ) ,
    'fr' => array(
        'aladdin'               => '1g7KVQnlyWpYS4iMMcsWsI',
        'cinderella'            => '3UJf4EQfVLIw55DGHTwfU7',
        'frozen'                => '3Oj7HAirMHgcrsBvAvBz2G',
        'mulan'                 => '08p8uHlpH3J3glp4enT6sx',
        'peterpan'              => '0p5GACBeBCqu6YVDp8HoVI',
        'pinocchio'             => '1hNAaxXFefsHxy9WDEuCTo',
        'pocahontas'            => '5RbIo0I1EmfK5LuL8TIqvG',
        'frog'                  => '7DP505aQybO5M236xLKBsX',
        'tangled'               => '4gzND0zCbvWjUIN97qmhAE',
        'junglebook'            => '6k3BwalwdZYIxpgGzNH4BP',
        'lionking'              => '2MO7y7tTFoEtDPI7sdf2vK',
        'bighero6'              => '2hUbtimwQNZsWd162386Jj',
        'mermaid'               => '5r4QvoXhTwP0ptdYBPbJ1m',
        'moana'                 => '1Jn4zy5USPYCC3KyTNUujX',
        'baymax'                => '2hUbtimwQNZsWd162386Jj'
    ),
    'co' => array(
        'aladdin'               => '29EiOQJnxWlX5nVOWQpu3u', // aladdin
        'cinderella'            => '6dedxHjFmdQz8Lly5LeMlK', // cinderella
        'frozen'                => '7lZs5r4oQV2nutddffLrg0', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '5zsAzctyWGNrchLWXFvKgz', // pinocchio
        'pocahontas'            => '0Wzu4sR8wqxT42H7Jk8STB', // pocahontas
        'frog'                  => '6zgvBxOmfWxrQi4Jxxki0P', // frog
        'tangled'               => '1l0aFrH24oPrQSqGtfeFyE', // tangled
        'junglebook'            => '7zdZNXoapFcOW663zgLdOE', // junglebook
        'lionking'              => '6BqcXoEgLpiGHQit2hXBIl', // lionking
        'bighero6'              => '2dcl6y3uR7MHvHIZnCxTAS', // bighero6
        'mermaid'               => '26qvLbGsCRhA2CV75IEa6U', // mermaid
        'moana'                 => '25IBuKrmZbgOVCGNigTXar', // moana
        'baymax'                => '2dcl6y3uR7MHvHIZnCxTAS' // baymax
    ),
    'ca' => array(
        'aladdin'               => '29EiOQJnxWlX5nVOWQpu3u',
        'cinderella'            => '6vFrF3FIZ1BdEG4aw4jxvg',
        'frozen'                => '7lZs5r4oQV2nutddffLrg0',
        'mulan'                 => '3Ohs7Jo6GM6mydUOL0m5aC',
        'peterpan'              => '1tCVqfTbVWmXFXx0HmGkob',
        'pinocchio'             => '5zsAzctyWGNrchLWXFvKgz',
        'pocahontas'            => '7L6kEZVkWh7OEI71b1JHZd',
        'frog'                  => '6zgvBxOmfWxrQi4Jxxki0P',
        'tangled'               => '1l0aFrH24oPrQSqGtfeFyE',
        'junglebook'            => '7zdZNXoapFcOW663zgLdOE',
        'lionking'              => '3YA5DdB3wSz4pdfEXoMyRd',
        'bighero6'              => '72FOmF0bBxV9zPY1463mmM',
        'mermaid'               => '3H75XHlF94Eo78ICk5GcZB',
        'moana'                 => '6pZj4nvx6lV3ulIK3BSjvs', // OK
        'baymax'                => '72FOmF0bBxV9zPY1463mmM'
    ),
    'it' => array(
        'aladdin'               => '1sDts3OfaHfd3aI7wYc0xD', // aladdin
        'cinderella'            => '73bUGexBpdTX4w3IwnP4wI', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '1Am7ZD8YAXeyBpilG0o30j', // mulan
        'peterpan'              => '7iyMw0LxuXgullyXfqQAye', // peterpan
        'pinocchio'             => '3xlw27izZUFReUPZ5vzCfu', // pinocchio
        'pocahontas'            => '1rrFfGFcqO2HPkh86qK2vE', // pocahontas
        'frog'                  => '1gq7uhfNW4QMeRr9msV68P', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '307g4Z7cXkPUMfHvkz8yvs', // junglebook
        'lionking'              => '0QIpinQBbhiaEivcc566Pl', // lionking
        'bighero6'              => '1w9B3IfGkH2T5CgcIy9QJG', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '56fg27ascDgA8gU9XhzdQ6', // moana
        'baymax'                => '1w9B3IfGkH2T5CgcIy9QJG' // baymax
    ),
    'es' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '6BMJZThp9tMZlP0WHVuTVE', // mulan
        'peterpan'              => '13SrOQVtVwuLbhMxnIeI0b', // peterpan
        'pinocchio'             => '1FmDVuoijHVUAa7y7Kr91b', // pinocchio
        'pocahontas'            => '0jUHi8bkw4tLAfc7X0MLub', // pocahontas
        'frog'                  => '1gq7uhfNW4QMeRr9msV68P', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2mi7luffSiJGNyH9X1SegK', // junglebook
        'lionking'              => '4UOhexwPupfdEPxQeysY81', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '5w5P7lTPAQAbgJX73on3gx', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'de' => array(
        'aladdin'               => '4q9SsGMJYzCoUiZSDvcWeQ', // aladdin
        'cinderella'            => '2l3hTyLK3Bnr0ywm45Fel6', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '6uicllEKGx3S5HNl1S8s3y', // mulan
        'peterpan'              => '2RqrmESofZ5CW98IjNkEOf', // peterpan
        'pinocchio'             => '6n6nHKPCj13uTnnTDzF7ec', // pinocchio
        'pocahontas'            => '3h8NXuO2Nk7iYKf2fWQ3zk', // pocahontas
        'frog'                  => '1gq7uhfNW4QMeRr9msV68P', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '5gcM1ksko8VKV6VNFSlKfo', // junglebook
        'lionking'              => '2LrcPkHBUfWdr2caUQaha6', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '0G6CKfBpgWYvYyjt3hoBst', // mermaid
        'moana'                 => '5w5P7lTPAQAbgJX73on3gx', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'ie' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '2zl74AAxR2uagYVy7660bQ', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '1gq7uhfNW4QMeRr9msV68P', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '77lVNxDvXAYThJzrCXlbln', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '5thnqtTNTuB2VhBLu58uLh', // moana OK
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'nl' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '1BCENwppsNiMxF7XHVSwbX', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '1gq7uhfNW4QMeRr9msV68P', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '77lVNxDvXAYThJzrCXlbln', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '78z8nnWbB2ytMI1ngOv4Vo', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'benl' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '2zl74AAxR2uagYVy7660bQ', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '1gq7uhfNW4QMeRr9msV68P', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '47x6zPm3SoEZwkh1P4BBGH', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '78z8nnWbB2ytMI1ngOv4Vo', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'befr' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3UJf4EQfVLIw55DGHTwfU7', // cinderella
        'frozen'                => '3Oj7HAirMHgcrsBvAvBz2G', // frozen
        'mulan'                 => '08p8uHlpH3J3glp4enT6sx', // mulan
        'peterpan'              => '0p5GACBeBCqu6YVDp8HoVI', // peterpan
        'pinocchio'             => '1hNAaxXFefsHxy9WDEuCTo', // pinocchio
        'pocahontas'            => '5RbIo0I1EmfK5LuL8TIqvG', // pocahontas
        'frog'                  => '7DP505aQybO5M236xLKBsX', // frog
        'tangled'               => '4gzND0zCbvWjUIN97qmhAE', // tangled
        'junglebook'            => '6k3BwalwdZYIxpgGzNH4BP', // junglebook
        'lionking'              => '2MO7y7tTFoEtDPI7sdf2vK', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '5r4QvoXhTwP0ptdYBPbJ1m', // mermaid
        'moana'                 => '1Jn4zy5USPYCC3KyTNUujX', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'bra' => array(
        'aladdin'               => '29EiOQJnxWlX5nVOWQpu3u', // aladdin
        'cinderella'            => '6dedxHjFmdQz8Lly5LeMlK', // cinderella
        'frozen'                => '7lZs5r4oQV2nutddffLrg0', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '5rbFduOfXKAL1kQc67Y35N', // pinocchio
        'pocahontas'            => '0Wzu4sR8wqxT42H7Jk8STB', // pocahontas
        'frog'                  => '6zgvBxOmfWxrQi4Jxxki0P', // frog
        'tangled'               => '1l0aFrH24oPrQSqGtfeFyE', // tangled
        'junglebook'            => '7zdZNXoapFcOW663zgLdOE', // junglebook
        'lionking'              => '6BqcXoEgLpiGHQit2hXBIl', // lionking
        'bighero6'              => '72FOmF0bBxV9zPY1463mmM', // bighero6
        'mermaid'               => '26qvLbGsCRhA2CV75IEa6U', // mermaid
        'moana'                 => '25IBuKrmZbgOVCGNigTXar', // moana
        'baymax'                => '72FOmF0bBxV9zPY1463mmM' // baymax
    ),
    'per' => array(
        'aladdin'               => '29EiOQJnxWlX5nVOWQpu3u', // aladdin
        'cinderella'            => '6dedxHjFmdQz8Lly5LeMlK', // cinderella
        'frozen'                => '7lZs5r4oQV2nutddffLrg0', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '5zsAzctyWGNrchLWXFvKgz', // pinocchio
        'pocahontas'            => '0Wzu4sR8wqxT42H7Jk8STB', // pocahontas
        'frog'                  => '6zgvBxOmfWxrQi4Jxxki0P', // frog
        'tangled'               => '1l0aFrH24oPrQSqGtfeFyE', // tangled
        'junglebook'            => '7zdZNXoapFcOW663zgLdOE', // junglebook
        'lionking'              => '6BqcXoEgLpiGHQit2hXBIl', // lionking
        'bighero6'              => '2dcl6y3uR7MHvHIZnCxTAS', // bighero6
        'mermaid'               => '26qvLbGsCRhA2CV75IEa6U', // mermaid
        'moana'                 => '25IBuKrmZbgOVCGNigTXar', // moana
        'baymax'                => '2dcl6y3uR7MHvHIZnCxTAS' // baymax
    ),
    'mx' => array(
        'aladdin'               => '29EiOQJnxWlX5nVOWQpu3u', // aladdin
        'cinderella'            => '6dedxHjFmdQz8Lly5LeMlK', // cinderella
        'frozen'                => '7lZs5r4oQV2nutddffLrg0', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '5zsAzctyWGNrchLWXFvKgz', // pinocchio
        'pocahontas'            => '0Wzu4sR8wqxT42H7Jk8STB', // pocahontas
        'frog'                  => '6zgvBxOmfWxrQi4Jxxki0P', // frog
        'tangled'               => '1l0aFrH24oPrQSqGtfeFyE', // tangled
        'junglebook'            => '7zdZNXoapFcOW663zgLdOE', // junglebook
        'lionking'              => '3YA5DdB3wSz4pdfEXoMyRd', // lionking
        'bighero6'              => '2dcl6y3uR7MHvHIZnCxTAS', // bighero6
        'mermaid'               => '26qvLbGsCRhA2CV75IEa6U', // mermaid
        'moana'                 => '2ho9l951XwxpBFEEjubOUx', // moana
        'baymax'                => '2dcl6y3uR7MHvHIZnCxTAS' // baymax
    ),
    'cl' => array(
        'aladdin'               => '29EiOQJnxWlX5nVOWQpu3u', // aladdin
        'cinderella'            => '6dedxHjFmdQz8Lly5LeMlK', // cinderella
        'frozen'                => '7lZs5r4oQV2nutddffLrg0', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '5zsAzctyWGNrchLWXFvKgz', // pinocchio
        'pocahontas'            => '0Wzu4sR8wqxT42H7Jk8STB', // pocahontas
        'frog'                  => '6zgvBxOmfWxrQi4Jxxki0P', // frog
        'tangled'               => '1l0aFrH24oPrQSqGtfeFyE', // tangled
        'junglebook'            => '7zdZNXoapFcOW663zgLdOE', // junglebook
        'lionking'              => '6BqcXoEgLpiGHQit2hXBIl', // lionking
        'bighero6'              => '2dcl6y3uR7MHvHIZnCxTAS', // bighero6
        'mermaid'               => '26qvLbGsCRhA2CV75IEa6U', // mermaid
        'moana'                 => '25IBuKrmZbgOVCGNigTXar', // moana
        'baymax'                => '2dcl6y3uR7MHvHIZnCxTAS' // baymax
    ),
    'arg' => array(
        'aladdin'               => '29EiOQJnxWlX5nVOWQpu3u', // aladdin
        'cinderella'            => '6dedxHjFmdQz8Lly5LeMlK', // cinderella
        'frozen'                => '7lZs5r4oQV2nutddffLrg0', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '5zsAzctyWGNrchLWXFvKgz', // pinocchio
        'pocahontas'            => '0Wzu4sR8wqxT42H7Jk8STB', // pocahontas
        'frog'                  => '6zgvBxOmfWxrQi4Jxxki0P', // frog
        'tangled'               => '1l0aFrH24oPrQSqGtfeFyE', // tangled
        'junglebook'            => '7zdZNXoapFcOW663zgLdOE', // junglebook
        'lionking'              => '6BqcXoEgLpiGHQit2hXBIl', // lionking
        'bighero6'              => '2dcl6y3uR7MHvHIZnCxTAS', // bighero6
        'mermaid'               => '26qvLbGsCRhA2CV75IEa6U', // mermaid
        'moana'                 => '25IBuKrmZbgOVCGNigTXar', // moana
        'baymax'                => '2dcl6y3uR7MHvHIZnCxTAS' // baymax
    ),
    'au' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '6UtWL1MOnEAua8BQb0l1g2', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '77lVNxDvXAYThJzrCXlbln', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '0G6CKfBpgWYvYyjt3hoBst', // mermaid
        'moana'                 => '5thnqtTNTuB2VhBLu58uLh', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'nz' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '6UtWL1MOnEAua8BQb0l1g2', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '77lVNxDvXAYThJzrCXlbln', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '0G6CKfBpgWYvYyjt3hoBst', // mermaid
        'moana'                 => '5thnqtTNTuB2VhBLu58uLh', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'sgp' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '6UtWL1MOnEAua8BQb0l1g2', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '77lVNxDvXAYThJzrCXlbln', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '2BnyvyHc9OVBBU8LlgA4C8', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'mys' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '6UtWL1MOnEAua8BQb0l1g2', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '77lVNxDvXAYThJzrCXlbln', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '2BnyvyHc9OVBBU8LlgA4C8', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'idn' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '6UtWL1MOnEAua8BQb0l1g2', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '77lVNxDvXAYThJzrCXlbln', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '2BnyvyHc9OVBBU8LlgA4C8', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'phl' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '5dyb6POrZn9ufPXB7CxtmT', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '6UtWL1MOnEAua8BQb0l1g2', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '77lVNxDvXAYThJzrCXlbln', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '2BnyvyHc9OVBBU8LlgA4C8', // moana
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    ),
    'prt' => array(
        'aladdin'               => '1Eq5qk8DnHWGOZT2cAASP2', // aladdin
        'cinderella'            => '3YbwIo6BvEzw0nNxVz5esL', // cinderella
        'frozen'                => '19dqa2yIehtaN4kBwpSEvP', // frozen
        'mulan'                 => '2peny9Rh8o8HxyXzg0eG6e', // mulan
        'peterpan'              => '2zl74AAxR2uagYVy7660bQ', // peterpan
        'pinocchio'             => '76dh1qvnOa0ZSfHrEOOVyK', // pinocchio
        'pocahontas'            => '4M9kB42Y2SfXzwuH903ycJ', // pocahontas
        'frog'                  => '1gq7uhfNW4QMeRr9msV68P', // frog
        'tangled'               => '4sG2hlPHNnVAKcBabJ5FS2', // tangled
        'junglebook'            => '2EdNK19Snday8yRRIuD0dK', // junglebook
        'lionking'              => '5S0ZNTwXUwu23csipWEfro', // lionking
        'bighero6'              => '2hUbtimwQNZsWd162386Jj', // bighero6
        'mermaid'               => '6uG53IqMUoIFbDkJ4gCPZj', // mermaid
        'moana'                 => '29QTMz7MU7FbAbifBqWPdM', // moana OK
        'baymax'                => '2hUbtimwQNZsWd162386Jj' // baymax
    )
);

// behind the scene

$assets = array(
    'us' => array(
         'image' => array(), // nom fichier sans chemin _img/lang/bts/lite ni extension .jpg
         'video' => array('qWQLVIFbA6A','jyl9mUfN7pM','X32GCthmdCQ','m5DaiwhslM0','Tbxiy14feeE','6_1htm_EUFo'), // 1 : dwayne, 2 : lin // id yt : le fichier id_youtube.jpg doit être présent dans _img/lang/bts/thumvid
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'uk' => array(
         'image' => array(),
         'video' => array('kKX1q4pOeFw','5WjxASAcTOI','uzaDPx_VcmI','wxcZyZxYGyc','rA4y6Ygn8E8','XeNErcIEEMw'), // 'nGfkNDa2xfE'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'au' => array(
         'image' => array(),
         'video' => array('fCmLqPfD8HI','-yvqEdaU4tI','V2BWhQzbYuY','3n7MNRublkc','jaHOj0U7Ggg','kKX1q4pOeFw'), // 'lbuCMTCAtYY'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'nz' => array(
         'image' => array(),
         'video' => array('fCmLqPfD8HI','-yvqEdaU4tI','V2BWhQzbYuY','3n7MNRublkc','jaHOj0U7Ggg','kKX1q4pOeFw'), // 'lbuCMTCAtYY'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'benl' => array(
         'image' => array(),
         'video' => array('MLd82GrD1vQ','i6v-guX2Vew','6gBvTwMulQ0','mPXT0mkCrXI','F7ucLC8VLfQ'), //'x8bjlWcY-Rc','afbbgJcsk-E'),
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'befr' => array(
         'image' => array(),
         'video' => array('6C__Et-wDhU','XyLWVc96i_U','wDL8Kx23hDA','x8bjlWcY-Rc','afbbgJcsk-E'), // 'VkgmVj2yob8'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'fr' => array(
         'image' => array(),
         'video' => array('NLIhVF-KbbE','LS5gS094PHE','Y2uOqbqxBgY','kSmhDM11CYA','s_lV1hwvm1c','mIuMzoUcVO4'), // 'JIl74jge_Wg'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'de' => array(
         'image' => array(),
         'video' => array('7IALpChvzPo','GD2JTukX96Y','4XoFXTQM9uE','1JBPwisl3tg','UsG0W63nnBg','2f1PFrnheVE'), // 'X-PjTz0BG44'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'nl' => array(
         'image' => array(),
         'video' => array('Bolmx3ps1jQ','59EvthC6rm0','OBL073GMprk','_S5laCdDSk0','efO1FStgOOg','KTg3k3zN7ro'), // 'npxtFMJgdUU'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'co' => array(
         'image' => array(),
         'video' => array('6T-2NoqdUEc','t6D9cRx3VSc','ei1rUS-Ru9Y','0hJHRhnu0XQ','rbxFrQQKFmM','0plxFSvoUhU'), // 'WUmEI6-Ow2o'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'ca' => array(
         'image' => array(),
         'video' => array('UZKsLB3JkB8','3PV3TN1rsCk','IhSPQXpFvV8','2Ji3WO72oBs','wqPB_SNU9Ms','omTMQuIqHu8'),
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'it' => array(
         'image' => array(),
         'video' => array('u115tC6_iuA','dlq7qTRhePA','f9F4B3mbi_w','LVxd6hiXVxM','72sjl3-cAUI','9bs7nCSpmbA'), // 'DZOPg9ZKjfY'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'es' => array(
         'image' => array(),
         'video' => array('RV-NorVpVnE','Ub_BZhg5m7s','t2tJNJwz0Ys','-A2SKmOMydY','VjgbiFmGxVo','e25049WL0K4'), // 'tmpTGztGJ8E'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'mx' => array(
         'image' => array(),
         'video' => array('6T-2NoqdUEc','t6D9cRx3VSc','ei1rUS-Ru9Y','0hJHRhnu0XQ','rbxFrQQKFmM','0plxFSvoUhU'), // 'WUmEI6-Ow2o'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'cl' => array(
         'image' => array(),
         'video' => array('6T-2NoqdUEc','t6D9cRx3VSc','ei1rUS-Ru9Y','0hJHRhnu0XQ','rbxFrQQKFmM','0plxFSvoUhU'), // 'WUmEI6-Ow2o'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'ennl' => array(
         'image' => array(),
         'video' => array(), // 'nGfkNDa2xfE'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'ie' => array(
         'image' => array(),
         'video' => array(), // 'nGfkNDa2xfE'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'mys' => array(
         'image' => array(),
         'video' => array('9ScwFx97Sec','uXSgbBp21pk','jhdcpp6yVXI','LVIOCk1aGLw','87FxNXSU9fE','EHT2unP-VOU'), // 'mX7oqAfkdIo'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'idn' => array(
         'image' => array(),
         'video' => array('xmma0lVFCgw','g1jy7Xt55no','_phg_OKUAVo','NvI6qqoBw-Y','s1IwgHUP61Q'), // 'raLXRLgHHqI'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'phl' => array(
         'image' => array(),
         'video' => array('ZqpjlhLRRXU','k04JdP3Y5dk','FZzlJPabiDo','BAJ2DhDIMKY','pgAlGdCAy7k','hXX6frBTtfA'), // 'waB4U9Wc3x4'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'sgp' => array(
         'image' => array(),
         'video' => array('3HBBMZbXIGA','KfY1uygjkig','qU-amnGzheE','PWXOSRIPta4','BWeXQA7qmPA','AHjRZvPWHX4'), // '_dGSM_jJ1Ho'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'arg' => array(
         'image' => array(),
         'video' => array('6T-2NoqdUEc','t6D9cRx3VSc','ei1rUS-Ru9Y','0hJHRhnu0XQ','rbxFrQQKFmM','0plxFSvoUhU'), // 'WUmEI6-Ow2o'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'per' => array(
         'image' => array(),
         'video' => array('6T-2NoqdUEc','t6D9cRx3VSc','ei1rUS-Ru9Y','0hJHRhnu0XQ','rbxFrQQKFmM','0plxFSvoUhU'), // 'WUmEI6-Ow2o'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'ven' => array(
         'image' => array(),
         'video' => array(),
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'prt' => array(
         'image' => array(),
         'video' => array('Ii1aTGIVeSQ','4cohWSZ_VyM','XZbhyo_7cHg','YHVRs_oKYtU','2mWkBisXCJ4','CIAl_fxW80s'), // 'TJALLlmWHhg'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        ),
    'bra' => array(
         'image' => array(),
         'video' => array('cCiMRRVeIS4','cMX-uD7dHPE','X5BkEVyAvDo','bNxoX9XfWKQ','wki8oxnVHYU','c33Uvn7Tgc4'), // '80q_uNi1Ip0'
         'plst'  => array(
        '0GeiwB5ll9Q60KRKGdRkKn', //Moana
        '5yOYfTfO6jeD3nMl9fmzqW', //Maui
        '3etHTENmURuH8rpn8Ev7UR', //Chief Tui
        '5QyhoibXbzCZsrYEc5MiFz', //Gramma Tala
        '7yAP0h9yQRA8v4QIpnuxKF', //Hei Hei
        '2on5g5dLdqvi0ulpY54K2G', //Tamatoa
        '3VIZPXmD9I7spomWV5YP8B', //Pua
        '7t3LxlY6yov1tdrex15myM'  //Kakamora
        )
        )

    );

//voyages
$voyages = array(
    'us' => array(
        array('id' => 'LKFuXETZUsI', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'uk' => array(
        array('id' => 'nGfkNDa2xfE', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'fr' => array(
        array('id' => 'JIl74jge_Wg', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'de' => array(
        array('id' => 'X-PjTz0BG44', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'ennl' => array(
        array('id' => 'nGfkNDa2xfE', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'nl' => array(
        array('id' => 'npxtFMJgdUU', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'benl' => array(
        array('id' => 'VkgmVj2yob8', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'befr' => array(
        array('id' => 'gG-P5BfteUw', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'co' => array(
        array('id' => 'WUmEI6-Ow2o', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'ca' => array(
        array('id' => 'P5wyFEbc6iI', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'it' => array(
        array('id' => 'DZOPg9ZKjfY', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'es' => array(
        array('id' => 'tmpTGztGJ8E', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'prt' => array(
        array('id' => 'TJALLlmWHhg', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'ie' => array(
        array('id' => 'nGfkNDa2xfE', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'au' => array(
        array('id' => 'lbuCMTCAtYY', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'nz' => array(
        array('id' => '7WKpN0AjYKo', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'cl' => array(
        array('id' => 'WUmEI6-Ow2o', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'arg' => array(
        array('id' => 'WUmEI6-Ow2o', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'per' => array(
        array('id' => 'WUmEI6-Ow2o', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'bra' => array(
        array('id' => '80q_uNi1Ip0', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'sgp' => array(
        array('id' => '_dGSM_jJ1Ho', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'mys' => array(
        array('id' => 'mX7oqAfkdIo', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'idn' => array(
        array('id' => 'raLXRLgHHqI', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'phl' => array(
        array('id' => 'waB4U9Wc3x4', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    ),
    'mx' => array(
        array('id' => 'WUmEI6-Ow2o', 'type' => 'yt', 'dejavu' => 0),
        array('id' => 'interhtml', 'type' => 'html', 'dejavu' => 0)
    )

);

// socials
$socials = array(
    'us' => array(
        'facebook'  => '',
        'youtube'   => '',
        'twitter'   => 'https://twitter.com/disneymoana',
        'insta'     => ''
    ),
     'uk' => array(
        'facebook'  => 'https://www.facebook.com/WaltDisneyStudiosUK/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosUK',
        'twitter'   => 'https://twitter.com/disney_uk',
        'insta'     => ''
    ),
    'ennl' => array(
        'facebook'  => 'https://www.facebook.com/DisneyUK/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosUK',
        'twitter'   => '',
        'insta'     => ''
    ),
    'ca' => array(
        'facebook'  => 'https://www.facebook.com/WaltDisneyStudiosCanada/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosCAN',
        'twitter'   => 'https://twitter.com/DisneyStudiosCA',
        'insta'     => ''
    ),
    'co' => array(
        'facebook'  => 'https://www.facebook.com/DisneyStudiosLA/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosLA',
        'twitter'   => '',
        'insta'     => ''
    ),
    'fr' => array(
        'facebook'  => 'https://www.facebook.com/WaltDisneyStudiosFr/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosFR',
        'twitter'   => 'https://twitter.com/Disneyfr',
        'insta'     => ''
    ),
    'befr' => array(
        'facebook'  => 'https://www.facebook.com/WaltDisneyStudiosFr/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosFR',
        'twitter'   => '',
        'insta'     => ''
    ),
    'benl' => array(
        'facebook'  => 'https://www.facebook.com/WaltDisneyBelgium/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosBE',
        'twitter'   => '',
        'insta'     => ''
    ),
    'nl' => array(
        'facebook'  => 'https://www.facebook.com/DisneyNL/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosNL',
        'twitter'   => '',
        'insta'     => ''
    ),
    'es' => array(
        'facebook'  => 'https://www.facebook.com/DisneySpain/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosES',
        'twitter'   => 'https://twitter.com/DisneySpain',
        'insta'     => ''
    ),
    'prt' => array(
        'facebook'  => 'https://www.facebook.com/DisneyPortugal/',
        'youtube'   => 'https://www.youtube.com/channel/UCiAqMiyIxSiGCM52iLnylGw',
        'twitter'   => '',
        'insta'     => ''
    ),
    'ie' => array(
        'facebook'  => 'https://www.facebook.com/DisneyUK/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosUK',
        'twitter'   => '',
        'insta'     => ''
    ),
    'de' => array(
        'facebook'  => 'https://www.facebook.com/disneydeutschland/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosDE',
        'twitter'   => '',
        'insta'     => ''
    ),
    'it' => array(
        'facebook'  => 'https://www.facebook.com/DisneyIT/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosIT',
        'twitter'   => '',
        'insta'     => ''
    ),
    'au' => array(
        'facebook'  => 'https://www.facebook.com/WaltDisneyStudiosAUNZ',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosAU/',
        'twitter'   => 'https://twitter.com/DisneyStudiosAU',
        'insta'     => ''
    ),
    'nz' => array(
        'facebook'  => 'https://www.facebook.com/WaltDisneyStudiosAUNZ',
        'youtube'   => 'https://www.youtube.com/WaltDisneyStudiosNZ/',
        'twitter'   => 'https://twitter.com/DisneyStudiosAU',
        'insta'     => ''
    ),
    'cl' => array(
        'facebook'  => 'https://www.facebook.com/DisneyStudiosLA/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosLA',
        'twitter'   => '',
        'insta'     => ''
    ),
    'arg' => array(
        'facebook'  => 'https://www.facebook.com/DisneyStudiosLA/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosLA',
        'twitter'   => '',
        'insta'     => ''
    ),
    'per' => array(
        'facebook'  => 'https://www.facebook.com/DisneyStudiosLA/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosLA',
        'twitter'   => '',
        'insta'     => ''
    ),
    'bra' => array(
        'facebook'  => 'https://www.facebook.com/DisneyMoviesBrasil/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosBR',
        'twitter'   => '',
        'insta'     => ''
    ),
    'sgp' => array(
        'facebook'  => 'https://www.facebook.com/disneystudiosSG/',
        'youtube'   => 'https://www.youtube.com/user/disneystudiosSG',
        'twitter'   => '',
        'insta'     => ''
    ),
    'mys' => array(
        'facebook'  => 'https://www.facebook.com/WaltDisneyStudiosMY/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosMY',
        'twitter'   => '',
        'insta'     => ''
    ),
    'idn' => array(
        'facebook'  => 'https://www.facebook.com/waltdisneystudiosindonesia/',
        'youtube'   => 'https://www.youtube.com/user/DisneyStudiosIndon',
        'twitter'   => '',
        'insta'     => ''
    ),
    'phl' => array(
        'facebook'  => 'https://www.facebook.com/waltdisneystudiosph/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosLA',
        'twitter'   => '',
        'insta'     => ''
    ),
    'mx' => array(
        'facebook'  => 'https://www.facebook.com/DisneyStudiosLA/',
        'youtube'   => 'https://www.youtube.com/user/WaltDisneyStudiosLA',
        'twitter'   => '',
        'insta'     => ''
    )

);


$og = array(
    'us' => array(
        'title'     => 'Moana\'s Musical Adventure',
        'descrp'    => 'Come aboard and take a musical journey with #Moana',
        'caption'   => 'Disney\'s Moana',
        'image'     => 'sharing_image_moana.jpg'
    ),
    'ca' => array(
        'title'     => 'Moana\'s Musical Adventure',
        'descrp'    => 'Come aboard and take a musical journey with #Moana - In theatres November 23rd',
        'caption'   => 'Disney\'s Moana',
        'image'     => 'sharing_image_moana.jpg'
    ),
    'esa' => array(
        'title'     => 'La aventura musical de Moana',
        'descrp'    => 'Sube a bordo de un viaje musical con #Moana',
        'caption'   => 'Moana',
        'image'     => 'sharing_image_moana.jpg'
    ),
    'es' => array(
        'title'     => 'La aventura musical de Vaiana',
        'descrp'    => 'Sube a bordo de un viaje musical con #Vaiana',
        'caption'   => 'Vaiana',
        'image'     => 'sharing_image_vaiana.jpg'
    ),
    'fr' => array(
        'title'     => 'L\'aventure musicale de Vaiana',
        'descrp'    => 'Monte à bord et pars à l\'aventure avec #Vaiana !',
        'caption'   => 'Vaiana',
        'image'     => 'sharing_image_vaiana.jpg'
    ),
    'de' => array(
        'title'     => 'Vaiana`s musikalisches Abenteuer',
        'descrp'    => 'Komm an Bord und erlebe die musikalische Reise von #vaiana',
        'caption'   => 'Disney`s Vaiana',
        'image'     => 'sharing_image_vaiana.jpg'
    ),
    'nl' => array(
        'title'     => 'Vaiana\'s Muzikale Avontuur',
        'descrp'    => 'Kom aan boord en beleef een muzikaal avontuur met #Vaiana',
        'caption'   => 'Disney\'s Vaiana',
        'image'     => 'sharing_image_vaiana.jpg'
    ),
    'it' => array(
        'title'     => 'L\'avventura musicale di Oceania',
        'descrp'    => 'Sali a bordo del viaggio musicale con #Oceania',
        'caption'   => 'Oceania Disney',
        'image'     => 'sharing_image_oceania.jpg'
    ),
    'prt' => array(
        'title'     => 'A aventura musical de Vaiana',
        'descrp'    => 'Suba a bordo para uma aventura musical com Vaiana',
        'caption'   => 'Disney Vaiana',
        'image'     => 'sharing_image_vaiana.jpg'
    ),
    'bra' => array(
        'title'     => 'A aventura musical de Moana',
        'descrp'    => 'Suba a bordo para uma aventura musical com Moana',
        'caption'   => 'Disney\'s Moana',
        'image'     => 'sharing_image_moana.jpg'
    ),
);

$og['ie'] = $og['uk'] = $og['au'] = $og['mys'] = $og['idn'] = $og['sgp'] = $og['phl'] = $og['us'];

$og['cl'] = $og['mx'] = $og['co'] = $og['arg'] = $og['per'] = $og['esa'];

$og['benl'] = $og['nl'];

// QUAND l'ALBUM DE MOANA EST DISPO : MOANA=1 ###########################################
$hosts = array(
    'it.oceania-spotify.com'    => array('lang' => 'it', 'rep' => 'it', 'code' => 'it', 'moana' => 0),    // italie
    'oceania-spotify.com'       => array('lang' => 'it', 'rep' => 'it', 'code' => 'it', 'moana' => 0),    // italie

    'fr.vaiana-spotify.com'     => array('lang' => 'fr', 'rep' => 'fr', 'code' => 'fr', 'moana' => 1),    // france
    'de.vaiana-spotify.com'     => array('lang' => 'de', 'rep' => 'de', 'code' => 'de', 'moana' => 0),    // allemagne
    'es.vaiana-spotify.com'     => array('lang' => 'es', 'rep' => 'es', 'code' => 'es', 'moana' => 0),    // espagne
    'nl.vaiana-spotify.com'     => array('lang' => 'nl', 'rep' => 'nl', 'code' => 'nl', 'moana' => 1),    // pays-bas
    'en.nl.vaiana-spotify.com'  => array('lang' => 'uk', 'rep' => 'ennl', 'code' => 'en-NL', 'moana' => 0),  // pays-bas EN
    'be.fr.vaiana-spotify.com'  => array('lang' => 'befr', 'rep' => 'befr', 'code' => 'be-FR', 'moana' => 1),  // belgique FR
    'be.nl.vaiana-spotify.com'  => array('lang' => 'benl', 'rep' => 'benl', 'code' =>'be-NL', 'moana' => 1),  // belgique NL

    'uk.moana-spotify.com'      => array('lang' => 'uk', 'rep' => 'uk', 'code' => 'en', 'moana' => 1),    // royaume-uni
    'ie.moana-spotify.com'      => array('lang' => 'ie', 'rep' => 'ie', 'code' => 'en', 'moana' => 1),    // ireland

    'us.moana-spotify.com'      => array('lang' => 'us', 'rep' => 'us', 'code' => 'us', 'moana' => 1),    // US
    'ca.moana-spotify.com'      => array('lang' => 'ca', 'rep' => 'ca', 'code' => 'en', 'moana' => 1),    // CA
    'mys.moana-spotify.com'     => array('lang' => 'mys', 'rep' => 'mys', 'code' => 'ml', 'moana' => 1),   // ancien malaisie
    'my.moana-spotify.com'     => array('lang' => 'mys', 'rep' => 'mys', 'code' => 'ml', 'moana' => 1),   // malaisie
    'idn.moana-spotify.com'     => array('lang' => 'idn', 'rep' => 'idn', 'code' => 'id', 'moana' => 1),   // ancien indonésie
    'id.moana-spotify.com'     => array('lang' => 'idn', 'rep' => 'idn', 'code' => 'id', 'moana' => 1),   // indonésie
    'phl.moana-spotify.com'     => array('lang' => 'phl', 'rep' => 'phl', 'code' => 'us', 'moana' => 1),   // ancien philippines
    'ph.moana-spotify.com'     => array('lang' => 'phl', 'rep' => 'phl', 'code' => 'us', 'moana' => 1),   // philippines
    'sgp.moana-spotify.com'     => array('lang' => 'sgp', 'rep' => 'sgp', 'code' => 'us', 'moana' => 1),   // ancien singapour
    'sg.moana-spotify.com'     => array('lang' => 'sgp', 'rep' => 'sgp', 'code' => 'us', 'moana' => 1),   // singapour
    'au.moana-spotify.com'     => array('lang' => 'au', 'rep' => 'au', 'code' => 'en', 'moana' => 1),      // australie

    // ES amerique du sud
    'cl.moana-spotify.com'      => array('lang' => 'cl', 'rep' => 'cl', 'code' => 'es', 'moana' => 0),    // chili
    'mx.moana-spotify.com'      => array('lang' => 'mx', 'rep' => 'mx', 'code' => 'es', 'moana' => 0),   // mexique
    'co.moana-spotify.com'      => array('lang' => 'co', 'rep' => 'co', 'code' => 'es', 'moana' => 0),    // colombie
    'arg.moana-spotify.com'     => array('lang' => 'arg', 'rep' => 'arg', 'code' => 'es', 'moana' => 0),   // argentine
    'per.moana-spotify.com'     => array('lang' => 'per', 'rep' => 'per', 'code' => 'es', 'moana' => 0),   // perou

    'ven.moana-spotify.com'     => array('lang' => 'ven', 'rep' => 'esa', 'code' => 'es', 'moana' => 0),    // venezuela OUT !

    'prt.vaiana-spotify.com'     => array('lang' => 'prt', 'rep' => 'prt', 'code' => 'pt', 'moana' => 1),    // portugal

    'bra.moana-spotify.com'     => array('lang' => 'bra', 'rep' => 'bra', 'code' => 'pt', 'moana' => 0)   // bresil
);

//$host = '/'.$_SERVER['HTTP_HOST'].'/';



if(array_key_exists($host, $hosts)) {
    $lang = $hosts[$host]['lang'];
    $cdl = $hosts[$host]['code'];
    $rep = $hosts[$host]['rep'];
    $moana = $hosts[$host]['moana'];
}

$local = '/'.$host.'/';
$lan = false;

if(preg_match($local,'servermac.local') || preg_match($local,'demo.moana-spotify.com') || preg_match($local,'smeserver9') || preg_match($local,'192.168.1.26') ){
    $lan = true;
    if($_GET){
        if(isset($_GET['host'])){
            $host = $_GET['host'];
            $lang = $hosts[$host]['lang'];
            $cdl = $hosts[$host]['code'];
            $rep = $hosts[$host]['rep'];
            $moana = $hosts[$host]['moana'];
        }
    }
}

if(!array_key_exists($lang,$trad)) {
    $lang = 'us';
    $cdl = 'us';
    $rep = 'us';
    $moana = 0;
}

$ctc='';
if($lang == 'au' || $lang == 'nz'){
    $ctc = '<div class="ctc"><img src="_img/'.$lang.'/ctc.png"/></div>';
}

//$urlspotify = 'https://play.spotify.com/user/disneymoana/playlist/';
$urlspotify = 'https://open.spotify.com/user/disneymoana/playlist/';

//$moanahome = 'moana_big.png';
$mobile = 0;
//$animgif = 'behind_anim.gif';
// test mobile

$useragent=$_SERVER['HTTP_USER_AGENT'];

$repmob = '';

if(preg_match("/(android|webos|avantgo|iphone|ipad|ipod|blackberry|iemobile|bolt|boost|cricket|docomo|fone|hiptop|mini|opera mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){
    $urlspotify = 'spotify:user:disneymoana:playlist:';
    //$moanahome = 'moana.png';
    //$animgif = 'behind_anim_mob.gif';
    $repmob = 'mob';
    $mobile = 1;
}

?>
<!DOCTYPE html>
<html lang="<?php echo $cdl ?>">
<head>
    <?php if(!$lan) { ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TBST63');</script>
    <!-- End Google Tag Manager -->
    <?php } ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="<?php echo $trad[$lang]['descr'] ?>">
    <meta name="keywords" content="<?php echo $trad[$lang]['keyw'] ?>">

    <meta property="og:url" content="<?php echo 'http://'.$host ?>" />
    <meta property="og:title" content="<?php echo $og[$lang]['title']?>" />
    <meta property="og:description" content="<?php echo $og[$lang]['descrp']?>" />
    <meta property="og:image" content="http://<?php echo $host ?>/_img/<?php echo $og[$lang]['image']?>" />

    <title><?php echo $trad[$lang]['title'] ?></title>
    <link rel="stylesheet" href="_img/<?php echo $rep ?>/style.css">

    <style type="text/css">

        .interhtml{
            z-index: 100;
            background: #0c537e;
        }

		.animhml, .animhml div {
			position: absolute;
            top:0;
            bottom: 0;
            right: 0;
            left: 0;
			animation-fill-mode: both;
			background-repeat: no-repeat;
            overflow: hidden;
		}

        .bghml {
			width: 100%;
			height: 100%;
			background-image: url(_media/bg.jpg);
            background-size: cover;
		}

        .bghml img, .boathml img, .seahml img, .skyhml img{
            width: 100%;
            height: auto;
        }


        .logohml {
			position: absolute;
            top: 3% !important;
            right: 0 !important;
            width: 30%;
            max-width: 540px;
            left:auto !important;
            bottom: auto !important;
			/*left: 20% !important;*/
			height: auto;
			-webkit-animation: animlogo .5s ease-in-out 0.7s;
                    animation: animlogo .5s ease-in-out 0.7s;
		}

        .logohml img{
            width:100%;
            height: auto;
        }

		.boathml {
            position: absolute;
            bottom: 0;
			left: 10%;
			width: 100%;
			height: auto;
		}

		.boathml img{
			position: absolute;
			bottom: -35%;
			left: 0;
			display: block;
			width: 100%;
			-webkit-animation: animboat 1.5s cubic-bezier(.68,1,.48,1) 1s forwards;
			animation: animboat 1.5s cubic-bezier(.68,1,.48,1) 1s forwards;
			opacity: 0;
		}

		.seahml {
			overflow: hidden;
			position: absolute;
			left: 0;
			bottom: 0;
			width: auto;
			height: 100%;
			-webkit-animation: animsea 1.5s ease-in-out .2s;
            animation: animsea 1.5s ease-in-out .2s;
		}

		.seahml img{
			width: 100%;
			position: absolute;
			bottom: -35%;
		}


		.skyhml {
			width: auto;
			height: 100%;
			-webkit-animation: animsky .5s ease-in-out .2s;
                    animation: animsky .5s ease-in-out .2s;
		}

        .skyhml img {
            width: auto;
            height: 100%;
        }

        @-webkit-keyframes animlogo {
			0% {opacity: 0;}
			100% {opacity: 1;}
		}
		@keyframes animlogo {
			0% {opacity: 0;}
			100% {opacity: 1;}
        }

        @-webkit-keyframes animsky {
			0% {opacity: 0; -webkit-transform: translateX(0px);}
			100% {opacity: 1; -webkit-transform: translateX(0px);}
		}
		@keyframes animsky {
			0% {opacity: 0; transform: translateX(0px);}
			100% {opacity: 1; transform: translateX(0px);}
        }

        @-webkit-keyframes animboat {
			0% {-webkit-transform: translateX(-10%) translateY(5%); opacity: 0;}
			100% {-webkit-transform: translateX(0) translateY(0); opacity: 1;}
		}
		@keyframes animboat {
			0% {transform: translateX(-10%) translateY(5%); opacity: 0;}
			100% {transform: translateX(0) translateY(0); opacity: 1;}
		}

        @keyframes animsea {
			0% {transform: translateY(10%); opacity: 0;}
			100% {transform: translateY(0); opacity: 1;}
		}
		 @-webkit-keyframes animsea {
			0% {-webkit-transform: translateY(10%); opacity: 0;}
			100% {-webkit-transform: translateY(0); opacity: 1;}
		}

        @media screen and (max-width:1024px){
            .bghml {
                width: 100%;
                height: 100%;
                background-image: url(_media/mob/bg.jpg);
                background-size: cover;
            }
        }


	</style>
    <style id="antiClickjack">body{display:none !important;}</style>
        <script type="text/javascript">
       if (self === top) {
           var antiClickjack = document.getElementById("antiClickjack");
           antiClickjack.parentNode.removeChild(antiClickjack);
       } else {
           top.location = self.location;
       }
    </script>
</head>

<body>
    <?php if(!$lan) { ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TBST63"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php } ?>
    <!-- images a preloader -->
    <div class="nodisplay">
    </div>

    <!-- classification -->
    <?php echo $ctc ?>

    <!-- logo spotify -->
    <div class="spotify"><img src="_img/spotify.png"/></div>

    <!-- interstitiel video -->
    <div class="page interst nodisplay" id="intervideo">
        <div class="calling"><img src="_img/<?php echo $rep ?>/oceaniscalling.png" width="" height="100%"/></div>
        <div id="minutes" class="minutes">
            <div class="travelling" id="travelling"><?php echo $trad[$lang]['travel']?></div>
            <div class="level1"><div class="level2" id="minuterie"></div></div>
        </div>
        <a href="#skip" id="skip" class="skip" data-album="0" data-ref="" data-num=""><img src="_img/skip_blk.png" id="ga-skipvideo"/></a>
        <div class="screenvideo interv">
            <img src="_img/videoblnk.png"/>
            <div id="ytvideo" class="videoyt">
                <div id="player1" class="player"></div>
            </div>
        </div>
        <a href="#share" class="share" id="share3"><img src="_img/share_blk.png" id="ga-calling-share"/></a>
    </div>

    <!-- MAP -->
    <div class="page" id="page2">
        <div class="instruct instzero" id="instruct"><img src="_img/<?php echo $rep ?>/move_around.png"/></div>
        <div class="footermap novisible" id="footermap1">
            <div class="vague"><img src="_img/vague_footer<?php echo $repmob ?>.png"/></div>
            <div class="moanafooter"><img src="_img/moana_footer<?php echo $repmob ?>.png"/></div>
            <div class="mauifooter"><img src="_img/maui_footer<?php echo $repmob ?>.png"/></div>
            <div class="logofooter"><img src="_img/<?php echo $rep ?>/moana_logo_footer.png"/></div>
        </div>

        <div class="contmap" id="contmap">
            <!-- <div id="blocking" class="blocking nodisplay"></div> -->
            <div id="twomaps" class="twomaps">
                <img src="_img/mapsblank.png" width="4470" height="1079"/>
                <div id="mapa" class="map">
                    <!--<object type="image/svg+xml" data="_img/map3-safari.svg" width="2235" height="1079"></object> -->
                    <img src="_img/map-safari2<?php echo $repmob ?>.png" id="imgmap1" style="width:2235px;height:1079px"/>
                    <div class="boatm opaczero" id="boat1"><img src="_img/boat_blk.png"/></div>
                    <a href="#peterpan" class="films film1 opaczero" id="film1a" data-album="<?php echo $albums[$lang]['peterpan']?>" data-num="5" data-bx="40" data-by="26"><img src="_img/logo_blk.png" id="ga-nda-peterpan-a"/></a>
                    <a href="#cinderella" class="films film2 opaczero" id="film2a" data-album="<?php echo $albums[$lang]['cinderella']?>" data-num="2" data-bx="40" data-by="32"><img src="_img/logo_blk.png" id="ga-nda-cinderella-a"/></a>
                    <a href="#frozen" class="films film3 opaczero" id="film3a" data-album="<?php echo $albums[$lang]['frozen']?>" data-num="3" data-bx="45" data-by="16"><img src="_img/logo_blk.png" id="ga-nda-frozen-a"/></a>
                    <a href="#tangled" class="films film4 opaczero" id="film4a" data-album="<?php echo $albums[$lang]['tangled']?>" data-num="9" data-bx="40" data-by="33"><img src="_img/logo_blk.png" id="ga-nda-tangled-a"/></a>
                    <a href="#mermaid" class="films film5 opaczero" id="film5a" data-album="<?php echo $albums[$lang]['mermaid']?>" data-num="13" data-bx="44" data-by="19"><img src="_img/logo_blk.png" id="ga-nda-mermaid-a"/></a>
                    <a href="#pinocchio" class="films film6 opaczero" id="film6a" data-album="<?php echo $albums[$lang]['pinocchio']?>" data-num="6" data-bx="40.5" data-by="37"><img src="_img/logo_blk.png" id="ga-nda-pinocchio-a"/></a>
                    <a href="#aladdin" class="films film7 opaczero" id="film7a" data-album="<?php echo $albums[$lang]['aladdin']?>" data-num="1" data-bx="60" data-by="53"><img src="_img/logo_blk.png" id="ga-nda-aladdin-a"/></a>
                    <a href="#mulan" class="films film8 opaczero" id="film8a" data-album="<?php echo $albums[$lang]['mulan']?>" data-num="4" data-bx="77.5" data-by="46.5"><img src="_img/logo_blk.png" id="ga-nda-mulan-a"/></a>
                    <a href="#lionking" class="films film9 opaczero" id="film9a" data-album="<?php echo $albums[$lang]['lionking']?>" data-num="11" data-bx="45" data-by="61"><img src="_img/logo_blk.png" id="ga-nda-lionking-a"/></a>
                    <a href="#junglebook" class="films film10 opaczero" id="film10a" data-album="<?php echo $albums[$lang]['junglebook']?>" data-num="10" data-bx="67.5" data-by="53"><img src="_img/logo_blk.png" id="ga-nda-junglebook-a"/></a>
                    <a href="#moana" class="films film11 opaczero" id="film11a" data-album="<?php echo $albums[$lang]['moana']?>" data-num="14" data-bx="93" data-by="62"><img src="_img/logo_blk.png" id="ga-nda-moana-a"/></a>
                    <a href="#pocahontas" class="films film12 opaczero" id="film12a" data-album="<?php echo $albums[$lang]['pocahontas']?>" data-num="7" data-bx="28.5" data-by="39"><img src="_img/logo_blk.png" id="ga-nda-pocahontas-a"/></a>
                    <a href="#bighero6" class="films film13 opaczero" id="film13a" data-album="<?php echo $albums[$lang]['bighero6']?>" data-num="12" data-bx="14" data-by="44"><img src="_img/logo_blk.png" id="ga-nda-bighero6-a"/></a>
                    <a href="#frog" class="films film14 opaczero" id="film14a" data-album="<?php echo $albums[$lang]['frog']?>" data-num="8" data-bx="28" data-by="44"><img src="_img/logo_blk.png" id="ga-nda-frog-a"/></a>
                    <a href="#baymax" class="films film15 opaczero<?php if ($lang=='au' || $lang=='nz') echo ' nodisplay' ?>" id="film15a" data-album="<?php echo $albums[$lang]['baymax']?>" data-num="15" data-bx="84" data-by="33.5"><img src="_img/logo_blk.png" id="ga-nda-baymax-a"/></a>
                </div>
                <div id="mapb" class="map map2">
                    <!--<object type="image/svg+xml" data="_img/map3-safari.svg" width="2235" height="1079"></object>-->
                    <img src="_img/map-safari2<?php echo $repmob ?>.png" id="imgmap2" style="width:2235px;height:1079px" />
                    <div class="boatm opaczero" id="boat2"><img src="_img/boat_blk.png"/></div>
                    <a href="#peterpan" class="films film1 opaczero" id="film1b" data-album="<?php echo $albums[$lang]['peterpan']?>" data-num="5" data-bx="40" data-by="26"><img src="_img/logo_blk.png" id="ga-nda-peterpan-b"/></a>
                    <a href="#cinderella" class="films film2 opaczero" id="film2b" data-album="<?php echo $albums[$lang]['cinderella']?>" data-num="2" data-bx="40" data-by="32"><img src="_img/logo_blk.png" id="ga-nda-cinderella-b"/></a>
                    <a href="#frozen" class="films film3 opaczero" id="film3b" data-album="<?php echo $albums[$lang]['frozen']?>" data-num="3" data-bx="45" data-by="16"><img src="_img/logo_blk.png" id="ga-nda-frozen-b"/></a>
                    <a href="#tangled" class="films film4 opaczero" id="film4b" data-album="<?php echo $albums[$lang]['tangled']?>" data-num="9" data-bx="40" data-by="33"><img src="_img/logo_blk.png" id="ga-nda-tangled-b"/></a>
                    <a href="#mermaid" class="films film5 opaczero" id="film5b" data-album="<?php echo $albums[$lang]['mermaid']?>" data-num="13" data-bx="44" data-by="19"><img src="_img/logo_blk.png" id="ga-nda-mermaid-b"/></a>
                    <a href="#pinocchio" class="films film6 opaczero" id="film6b" data-album="<?php echo $albums[$lang]['pinocchio']?>" data-num="6" data-bx="40.5" data-by="37"><img src="_img/logo_blk.png" id="ga-nda-pinocchio-b"/></a>
                    <a href="#aladdin" class="films film7 opaczero" id="film7b" data-album="<?php echo $albums[$lang]['aladdin']?>" data-num="1" data-bx="60" data-by="53"><img src="_img/logo_blk.png" id="ga-nda-aladdin-b"/></a>
                    <a href="#mulan" class="films film8 opaczero" id="film8b" data-album="<?php echo $albums[$lang]['mulan']?>" data-num="4" data-bx="77.5" data-by="46.5"><img src="_img/logo_blk.png" id="ga-nda-mulan-b"/></a>
                    <a href="#lionking" class="films film9 opaczero" id="film9b" data-album="<?php echo $albums[$lang]['lionking']?>" data-num="11" data-bx="45" data-by="61"><img src="_img/logo_blk.png" id="ga-nda-lionking-b"/></a>
                    <a href="#junglebook" class="films film10 opaczero" id="film10b" data-album="<?php echo $albums[$lang]['junglebook']?>" data-num="10" data-bx="67.5" data-by="53"><img src="_img/logo_blk.png" id="ga-nda-junglebook-b"/></a>
                    <a href="#moana" class="films film11 opaczero" id="film11b" data-album="<?php echo $albums[$lang]['moana']?>" data-num="14" data-bx="93" data-by="62"><img src="_img/logo_blk.png" id="ga-nda-moana-b"/></a>
                    <a href="#pocahontas" class="films film12 opaczero" id="film12b" data-album="<?php echo $albums[$lang]['pocahontas']?>" data-num="7" data-bx="28.5" data-by="39"><img src="_img/logo_blk.png" id="ga-nda-pocahontas-b"/></a>
                    <a href="#bighero6" class="films film13 opaczero" id="film13b" data-album="<?php echo $albums[$lang]['bighero6']?>" data-num="12" data-bx="14" data-by="44"><img src="_img/logo_blk.png" id="ga-nda-bighero6-b"/></a>
                    <a href="#frog" class="films film14 opaczero" id="film14b" data-album="<?php echo $albums[$lang]['frog']?>" data-num="8" data-bx="28" data-by="44"><img src="_img/logo_blk.png" id="ga-nda-frog-b"/></a>
                    <a href="#baymax" class="films film15 opaczero<?php if ($lang=='au'|| $lang=='nz') echo ' nodisplay' ?>" id="film15b" data-album="<?php echo $albums[$lang]['baymax']?>" data-num="15" data-bx="84" data-by="33.5"><img src="_img/logo_blk.png" id="ga-nda-baymax-b"/></a>
                </div>
            </div>
        </div>
        <?php
        $class=' nodisplay';
        if(array_key_exists($lang,$assets) && (!empty($assets[$lang]['video']) || !empty($assets[$lang]['plst']))) $class='';
        ?>
        <a href="#behind" class="behind novisible<?php echo $class ?>" id="behind"><span class="btn"><img src="_img/behind_blk.png" id="ga-behind-scene"/></span><span class="anim"><img src="_img/behind_anim<?php echo $repmob ?>.gif" id="ga-behind-scene-anim"/></span></a>
        <div class="zooms novisible" id="zooms">
            <a href="#moins" id="zmin" class="zoom moins"><img src="_img/square_blk.png"/></a>
            <a href="#plus" id="zplus" class="zoom plus"><img src="_img/square_blk.png"/></a>
        </div>
    </div>

    <!-- playlist album -->
    <div class="page albums novisible" id="albums">
        <div class="footermap">
            <div class="vague"><img src="_img/vague_footer<?php echo $repmob ?>.png"/></div>
            <div class="moanafooter2"><img src="_img/moana_footer2<?php echo $repmob ?>.png" id="moana3"/></div>
            <div class="logofooter floatleft"><img src="_img/<?php echo $rep ?>/moana_logo_footer.png"/><img src="_img/<?php echo $rep?>/in_theatre.png" class="theatre2"/></div>
        </div>

        <div class="rich">
            <a href="#continue2" class="close" id="close2"><img src="_img/close_button.png" id="ga-playlist-close"/></a>
            <img src="_img/rich_blk.png" class="fake"/>
            <div class="contenu">
                <div class="pctalbum"><div class="imgalbum"><img src="_img/loading.gif" id="posters"/></div><img src="_img/affiche_blk2.png"/></div>
                <img src="_img/affiche_blk2.png" class="floating"/>
                <div id="album" class="album"></div>
            </div>
            <div class="sharecont" id="sharecont">
                <a href="#continue2" id="continue2" class="continue"><img src="_img/share_blk.png" id="ga-playlist-continue"/></a>
                <a href="#share" target="_blank" id="share2" class="share"><img src="_img/share_blk.png" id="ga-playlist-share"/></a>
            </div>
        </div>

    </div>


    <!-- intro -->
    <div class="page intro" id="page1">
        <div class="legals"><img src="_img/<?php echo $rep ?>/legals.png"/></div>
        <div class="logo1"><img src="_img/<?php echo $rep ?>/moana-logo.png"/></div>
        <div class="bloctitre">
            <div class="boat"><img src="_img/boat.png"/></div>
            <div class="aboard"><img src="_img/<?php echo $rep ?>/come_aboard.png"/></div>
            <div class="trait"><img src="_img/trait.png"/></div>
            <div class="move"><img src="_img/<?php echo $rep ?>/move_around.png"/></div>
            <a href="#start" id="start"><img src="_img/start_now_blk.png" id="ga-start-now"/></a>
        </div>
    </div>

    <!-- behind the scenes -->
    <div class="page novisible" id="page7">
        <div class="footermap">
            <div class="vague"><img src="_img/vague_footer.png"/></div>
            <div class="moanafooter2"><img src="_img/moana_footer2.png" id="moana2"/></div>
            <div class="logofooter floatleft"><img src="_img/<?php echo $rep ?>/moana_logo_footer.png"/><img src="_img/<?php echo $rep ?>/in_theatre.png" class="theatre"/></div>
            <!-- <div class="theatre"><img src="_img/<?php echo $rep ?>/in_theatre.png"/></div> -->
        </div>
        <div class="rich">
            <a href="#continue1" class="close" id="close1"><img src="_img/close_button.png" id="ga-behind-scene-continue"/></a>
            <img src="_img/rich_blk.png" class="fake"/>
            <div class="contenu">
                <div class="titreb"><img src="_img/<?php echo $rep ?>/behindscene.png"/></div>
                <div class="blocg" id="blocg">
                    <a href="#prec" class="nav prec nodisplay" id="prec"></a>
                        <div class="affiche">
                            <img src="_img/<?php echo $rep ?>/bts/big/image01.jpg" id="affiche" class="aff1"/>
                            <img src="_img/affiche_blk.png" class="aff2"/>
                        </div>
                    <a href="#suiv" class="nav suiv nodisplay" id="suiv"></a>
                </div>
                <div class="blocd" id="blocd">
                    <ul class="menu">
                        <?php $class='';if (empty($assets[$lang]['image'])) $class=' class="nodisplay"' ; ?><li<?php echo $class ?>><a href="#images" id="thimg"><?php echo $trad[$lang]['image'] ?></a></li>
                        <?php $class='';if (empty($assets[$lang]['video'])) $class=' class="nodisplay"' ; ?><li<?php echo $class ?>><a href="#videos" id="thvideo"><?php echo $trad[$lang]['video'] ?></a></li>
                        <?php $class='';if (empty($assets[$lang]['plst'])) $class=' class="nodisplay"' ; ?><li<?php echo $class ?>><a href="#playlists" id="thplst"><?php echo $trad[$lang]['plst'] ?></a></li>
                    </ul>
                    <div class="thumb" id="thumb"></div>
                </div>
                <div class="screenvideo nodisplay" id="btsvideo">
                    <a href="#closevideo" id="closevid" class="closevid"><img src="_img/x_blk.png" id="ga-btsvideo-close"/></a>
                    <img src="_img/videoblnk.png"/>
                    <div id="ytvideo" class="videoyt">
                        <div id="player2" class="player"></div>
                    </div>
                </div>
            </div>
            <div class="soon" id="soon"><img src="_img/<?php echo $rep ?>/returnsoon.png"/></div>
            <div class="sharecont" id="sharecont">
                <!--<a href="#continue1" id="continue1" class="continue"><img src="_img/share_blk.png"/></a>-->
                <a href="#skipbts" id="skipbts" class="skipbts" data-album="0" data-ref=""><img src="_img/skip_blk.png" id="ga-skipvideo-autoplaybts"/></a>
                <a href="#share" id="share1" class="shareonly novisible"><img src="_img/share_blk.png" id="ga-behind-scene-share"/></a>
            </div>
        </div>
    </div>

    <!-- interstitiel html -->
    <div class="page nodisplay interhtml" id="interhtml">
        <div class="animhml">
            <div class="bghml"></div>
            <div class="skyhml"><img src="_media/<?php echo $repmob.'/'; ?>sky.jpg"/></div>
            <div class="boathml"><img src="_media/<?php echo $repmob.'/'; ?>boat.png"/></div>
            <div class="seahml"><img src="_media/<?php echo $repmob.'/'; ?>sea.png"/></div>
            <div class="logohml"><img src="_img/<?php echo $rep ?>/moana-logo.png"/></div>
        </div>
    </div>

    <ul class="socials novisible" id="socials">
        <?php $slink = $socials[$lang] ?>
        <?php if (!empty($slink['facebook'])) { ?>
        <li><a href="<?php echo $socials[$lang]['facebook'] ?>" target="_blank" class="fb"><img src="_img/socials/facebook.png" id="ga-facebook-btn"/></a></li>
        <?php
            }
            if (!empty($slink['twitter'])) { ?>
        <li><a href="<?php echo $socials[$lang]['twitter'] ?>" target="_blank" class="tw"><img src="_img/socials/twitter.png" id="ga-twitter-btn"/></a></li>
        <?php
            }
            if (!empty($slink['youtube'])) { ?>
        <li><a href="<?php echo $socials[$lang]['youtube'] ?>" target="_blank" class="yt"><img src="_img/socials/youtube.png" id="ga-youtube-btn"/></a></li>
        <?php
            }
            if (!empty($slink['insta'])) { ?>
        <li><a href="<?php echo $socials[$lang]['insta'] ?>" target="_blank" class="ins"><img src="_img/socials/insta.png" id="ga-instagram-btn"/></a></li>
        <?php } ?>
    </ul>

    <div class="page blocked">
        <p><?php echo $trad[$lang]['turn']?></p>
        <div class="footermap">
            <div class="vague"><img src="_img/vague_footer<?php echo $repmob ?>.png"/></div>
            <div class="moanafooter"><img src="_img/moana_footer<?php echo $repmob ?>.png"/></div>
            <div class="mauifooter"><img src="_img/maui_footer<?php echo $repmob ?>.png"/></div>
            <div class="logofooter"><img src="_img/<?php echo $rep ?>/moana_logo_footer.png"/></div>
        </div>
    </div>

    <div class="loader" id="loader">
        <div class="level3"><div class="level4" id="loading"></div></div>
    </div>

    <script type="text/javascript" src="_js/manageEvents1.2.js"></script>
    <script type="text/javascript" src="_js/manageEventsTransition.1.0.js"></script>
    <!--<script type="text/javascript" src="_js/q.min.js"></script>
    <script type="text/javascript" src="_js/manageEventsPromises1.0.js"></script>-->
    <script type="text/javascript" src="_js/manageEventsImageLoader.js"></script>

    <script type="text/javascript">

    // video --------------------------------------------------------------------------

    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";
    //tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player1, player2, curscreen = 0,
        urlfb = 'https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://'.$host); ?>',
        lang = '<?php echo $lang ?>',
        rep = '<?php echo $rep ?>',
        urlspt = '<?php echo $urlspotify ?>',
        msgsoon =  '<p class="soon"><?php echo $trad[$lang]['soon'] ?></p>',
        mobile = '<?php echo $mobile ?>',
        moana = '<?php echo $moana ?>',
        albums = [
            {'album':1, 'poster':'aladdin.jpg', '<?php echo $albums[$lang]['aladdin'] ?>':{}},
            {'album':2, 'poster':'cinderella.jpg', '<?php echo $albums[$lang]['cinderella'] ?>':{}},
            {'album':3, 'poster':'frozen.jpg', '<?php echo $albums[$lang]['frozen'] ?>':{}},
            {'album':4, 'poster':'mulan.jpg', '<?php echo $albums[$lang]['mulan'] ?>':{}},
            {'album':5, 'poster':'peterpan.jpg', '<?php echo $albums[$lang]['peterpan'] ?>':{}},
            {'album':6, 'poster':'pinocchio.jpg', '<?php echo $albums[$lang]['pinocchio'] ?>':{}},
            {'album':7, 'poster':'pocahontas.jpg', '<?php echo $albums[$lang]['pocahontas'] ?>':{}},
            {'album':8, 'poster':'frog.jpg', '<?php echo $albums[$lang]['frog'] ?>':{}},
            {'album':9, 'poster':'tangled.jpg', '<?php echo $albums[$lang]['tangled'] ?>':{}},
            {'album':10,'poster':'junglebook.jpg', '<?php echo $albums[$lang]['junglebook'] ?>':{}},
            {'album':11,'poster':'lionking.jpg', '<?php echo $albums[$lang]['lionking'] ?>':{}},
            {'album':12,'poster':'bighero6.jpg', '<?php echo $albums[$lang]['bighero6'] ?>':{}},
            {'album':13,'poster':'mermaid.jpg', '<?php echo $albums[$lang]['mermaid'] ?>':{}},
            {'album':14,'poster':'moana.jpg', '<?php echo $albums[$lang]['moana'] ?>':{}},
            {'album':15,'poster':'baymax.jpg', '<?php echo $albums[$lang]['baymax'] ?>':{}}
        ],
        assets = [
            {'asset': ['<?php echo implode("','",$assets[$lang]['image']) ?>']},
            {'asset': ['<?php echo implode("','",$assets[$lang]['video']) ?>']},
            {'asset': ['<?php echo implode("','",$assets[$lang]['plst']) ?>']}
        ],

        voyages = <?php echo json_encode($voyages[$lang]) ?>;

    function onYouTubePlayerAPIReady() {
        // interstitiel video
        player1 = new YT.Player('player1', {
            width: '100%',
            height: '100%',
            videoId: '',
            playerVars: {'autoplay': 0, 'controls': 1, 'html5': 1 ,'enablejsapi':0,'showinfo':0,'iv_load_policy':3,'modestbranding':1,'rel':0},
            events: {
                'onReady': onPlayerReady1,
                'onStateChange': onPlayerStateChange1
            }
        });
        // player video BTS
        player2 = new YT.Player('player2', {
            width: '100%',
            height: '100%',
            videoId: '',
            playerVars: {'autoplay': 0, 'controls': 1, 'html5': 1 ,'enablejsapi':0,'showinfo':0,'iv_load_policy':3,'modestbranding':1,'rel':0},
            events: {
                'onReady': onPlayerReady2,
                'onStateChange': onPlayerStateChange2
            }
        });
    };

    // interstitiel video
    function onPlayerReady1(event) {
        //event.target.playVideo();
    };

    function onPlayerStateChange1(event) {
        switch(event.data){
            case -1:
                console.log('video non demarree');
                break;
            case 3:
                console.log('tampon video');
                break;
            case 1:
                console.log('lecture video');
                //startlevelTimer(300,5000,afterMinuterie);
                break;
             case 0:
                finintervideo();
                console.log('video arretee'); // fin video
                break;
            case 2:
                console.log('video en pause');
                break;
        }
    };


    // video BTS
    function onPlayerReady2(event) {
        //event.target.playVideo();
    };

    function onPlayerStateChange2(event) {
        switch(event.data){
            case -1:
                console.log('video non demarree');
                break;
            case 3:
                console.log('tampon video');
                break;
            case 1:
                console.log('lecture 2 video');
                //startlevelTimer(300,10000,afterMinuterie);
                break;
             case 0:
                finBTSvideo(true);
                console.log('video 2 arretee'); // fin video
                break;
            case 2:
                console.log('video 2 en pause');
                break;
        }
    };

    // closure
   (function(){
       /*
       window.navigator.sayswho = (function(){
            var ua = navigator.userAgent, tem,
            M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [],
            P = navigator.platform;
            if(/trident/i.test(M[1])){
                tem =  /\brv[ :]+(\d+)/g.exec(ua) || [];
                return 'IE '+(tem[1] || '');
            }
            if(M[1] === 'Chrome'){
                tem = ua.match(/\b(OPR|Edge)\/(\d+)/);
                if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
            }
            M = M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
            M[3] = P;
            if((tem = ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
            return M.join(' ');
        })();

        alert(window.navigator.sayswho);
       */

        var urlspotify = window.urlspt, // utilise dans BTS pour lancer les playlists
        lang = window.lang,
        urlfb = window.urlfb,
        rep = window.rep,
        moana = window.moana,
        request = false,
        autoplay = true,        // joue toutes les pistes automatiquement
        curTracks = 0,          // piste en cours de lecture (numero de piste)
        totTracks = 0,          // total des pistes en cours de lecture (nombre total de pistes)
        curSongId = 0,          // id de la piste en cours
        audioTag,
        albums = window.albums,
        assets = window.assets,
        //token = window.token,
        voyages = window.voyages,
        msgsoon = window.msgsoon,
        mobile = parseInt(window.mobile),
        lang,
        tmap,               // twomaps
        map1,               // mapa
        map2,               // mapb
        hmap = 1.0,         // scale
        initmouseX = 0,     // mouseX on mousedown
        initmouseY = 0,     // mouseY on mousedown
        offsetx = 0,        // translate x
        offsety = 0,        // translate y
        oldoffsetx = 0,     // translate x on mouseup
        oldoffsety = 0,     // translate y on mouseup
        xmap = 4470,        // taille de la map
        xmap2 = 2235,       // taille de la double map divisee par 2 : 4470 / 2
        _htmap = 1079,      // hauteur de la map
        diffx = 0,          // ecart pinch horizontal
        diffy = 0,          // ecart pinch vertival
        zmax = 1.4,         // zoom max
        zmin = .7,          // zoom min
        _zoom = .02,        // increment zooming
        _timer,             // setInterval pour duree min video
        //poster = '',      // image de poster de la playlist album
        curbtsimg = 0,
        mapenable = true,
        imgload = 0,        // num image chargées
        interzoom = null,   // vrariable pour les boutons zoom;
        //firstClic = 0,    // premier clic sur la map
        started = 0,        // clic sur start = 1
        ochanged = 0,       // pour ne pas faire l'init de l'écran 50 fois
        currentnode = '',   // id du title cliqué

        $ID = function(id){
            var elem = null;
            if (document.getElementById(id) !== null) elem = document.getElementById(id);
            if(elem == null) console.log('%cERREUR : id "' + id + '" introuvable','color:#ff1d00;font-weight:bold');
            return elem;
        },

        addAclass = function (id, classe){
            $ID(id).classList ? $ID(id).classList.add(classe) : $ID(id).className += ' '+classe;
        },

        removeAclass = function(id,classe){
            $ID(id).className = $ID(id).className.replace(' ' + classe, '').replace(classe, '');
        },

        hasAclass = function(id, cls) {
            var element = $ID(id);
            return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
        },

        afterVoyage = function(){
            addAclass('interhtml','nodisplay');
            finintervideo();
        },

        getVoyages = function(){
            if(voyages.length == 0) return true;
            for(var i = 0; i < voyages.length; i++){
                if(voyages[i].type == 'yt' && voyages[i].dejavu == 0){
                    window.player1.loadVideoById(voyages[i].id);
                    voyages[i].dejavu = 1;
                    removeAclass('intervideo','nodisplay');
                    startlevelTimer(300,5000,afterMinuterie);
                    return false;
                    break;
                }
                if(voyages[i].type == 'html' && voyages[i].dejavu == 0){
                    voyages[i].dejavu = 1;
                    removeAclass('interhtml','nodisplay');
                    startlevelTimer(300,3500, afterVoyage);
                    return false;
                    break;
                }

            }
            return true;
        },

        getPoster = function (n){
            var rt = 'posterblnk.gif';
            for(var i = 0; i<albums.length; i++){
                //if(albums[i].hasOwnProperty(id)){
                if(albums[i].album == n){
                    rt = albums[i]['poster'];
                }
            }
            return rt;
        },

        getAlbum = function(id,h,n){

            var imgposter = getPoster(n);
            $ID('posters').src = '_img/' + rep + '/posters/'+imgposter;

            if(id !== ''){
                var src = 'https://embed.spotify.com/?uri=spotify:album:'+id+'&view=list';
                //var id = t.getAttribute('data-album');
                var res = '<iframe id="theframe" src="' + src + '" width="380" height="300" frameborder="0" allowtransparency="true"></iframe>';
                if(h == '#moana' && moana === '0' ) res += '<div class="pastille"><img src="_img/' + rep + '/pastille.png"/></div>';
                $ID('album').innerHTML = res;
            }else{
                $ID('album').innerHTML = '<div class="pastille"><img src="_img/' + rep + '/pastille.png"/></div>';
            }
            return false;

        },

        getScalefromZoom = function(){
            var st = window.getComputedStyle(tmap, null);
            var tr = st.getPropertyValue('transform');
            if(tr !== null){
                var values = tr.split('(')[1];
                values = values.split(')')[0];
                values = values.split(',');
                var _x = parseInt(values[4]);
                var _y = parseInt(values[5]);

                if(_x != 0) oldoffsetx = _x;
                if(_y != 0) oldoffsety = _y;
            }
        },

        stoplevelTimer = function(){
            clearInterval(_timer);
        },

        startlevelTimer = function(tick,duration,cb){
            var incr = (tick/duration)*100;
            var ll = $ID('minuterie');
            var pc = 0;
            var callback = cb;
            _timer = setInterval(function(){
                pc += incr;
                if(pc > 100) pc = 100;
                ll.style.width = pc+'%';
                if(pc == 100){
                    callback();
                    stoplevelTimer();
                }
           },tick);
        },

        finintervideo = function(){

            window.player1.stopVideo();
            var id = $ID('skip').getAttribute('data-album');
            var ref = $ID('skip').getAttribute('data-ref');
            var num = $ID('skip').getAttribute('data-num');
            autoplay = true;
            getAlbum(id,ref,num);
            addAclass('intervideo','nodisplay');
            addAclass('moana3','moanafanim');

        },

        finBTSvideo = function(f){
            addAclass('btsvideo','nodisplay');
            removeAclass('blocg','novisible');
            removeAclass('blocd','novisible');
            removeAclass('soon','novisible');
            if(f){
                removeAclass('close1','novisible');
                removeAclass('closevid','novisible');
                addAclass('skipbts','novisible');
                removeAclass('share1','novisible');

            }
        },

        refreshMap = function(){

            var tt = tmap.getBoundingClientRect();

            if(tt.width/2 < window.innerWidth){

                manageEvents.listenerRemove('contmap','mousemove', true);
                manageEvents.listenerRemove('contmap','touchmove',true);
                // centrage vertical
                oldoffsety = offsety = (window.innerHeight - _htmap)/2;
                // centrage horizontal
                oldoffsetx = offsetx =  (window.innerWidth - (xmap2*hmap))/2;

                tmap.style.transform = 'translate(' + offsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + offsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + offsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                addAclass('mapb','novisible');
                return false;
            }else{
                removeAclass('mapb','novisible');
            }

            if(tt.left>=0){
                oldoffsetx = offsetx = oldoffsetx - xmap2 * hmap;//(offsetx)-(xmap2);//*hmap);
                tmap.style.transform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                return true;
            }

            if(tt.right <= window.innerWidth){
                oldoffsetx = offsetx = oldoffsetx + xmap2 * hmap;
                oldoffsetx = offsetx-10;
                tmap.style.transform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                return true;
            }

            return false;

        },

        initMaps = function(nd, easing){

            var moa = $ID(nd).getBoundingClientRect();
            var imapa = map1.getBoundingClientRect();
            var mtop = $ID(nd).offsetTop;
            var mleft = $ID(nd).offsetLeft;
            var parnt = $ID(nd).parentNode.getAttribute('id');

            addAclass('twomaps','transmap');
            manageEvents.listenertransAdd('twomaps', 'transitionend', easing);

            var decal = parnt == 'mapb' ? xmap2 : 0;

            map1.style.left = '0px';
            map2.style.left = xmap2 + 'px';

            if(window.innerWidth > 1024) {
                hmap = .9;
            }

            if(window.innerWidth <= 1024 && window.innerWidth > 700) {
                zmin = .5;
                hmap = .7;

           }

            if(window.innerWidth <= 700) {
                zmin = .4;
                hmap = .6;
            }

            oldoffsetx = offsetx = -(mleft+decal)*hmap+(window.innerWidth/2)-((moa.width/2)*hmap);
            oldoffsety = offsety = ((_htmap*hmap)-_htmap)/2 - (mtop*hmap-window.innerHeight/2);

            tmap.style.transform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
            tmap.style.msTransform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
            tmap.style.WebkitTransform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';

            //refreshMap();
        },

        movemap = function(e,t,ct){

            if(!mapenable) return false;

            refreshMap();

            var x,y;
            var tt = tmap.getBoundingClientRect();

            if(tt.width < window.innerWidth) {
                manageEvents.listenerRemove('contmap','touchmove',true);
                manageEvents.listenerRemove('contmap','mousemove', true);
                return false;
            }
            var tlf = tt.left;
            var trg = tt.right;

            // zoom touch
            if(e.changedTouches && e.touches.length > 1){
                manageEvents.listenerRemove('contmap','touchmove',true);
                return false;
            }

            // > 2 touch : rien
            if(e.changedTouches && e.touches.length > 2){
                manageEvents.listenerRemove('contmap','touchmove',true);
                return false;
            }

            // touch
            if(e.changedTouches && e.touches.length == 1 && tlf  < 0){

                x = e.changedTouches[0].clientX;
                y = e.changedTouches[0].clientY;

                offsetx = x-initmouseX+oldoffsetx;
                offsety = y-initmouseY+oldoffsety;
                //tmap.style.transform = 'scale(' + hmap + ')';
                tmap.style.transform = 'translate(' + offsetx + 'px,' + offsety +'px) scale(' + hmap + ')';

            }


            // pas touch
            if(!e.changedTouches && (tlf <= 0 || trg > window.innerWidth)){
                x = e.x === undefined ? e.clientX : e.x;
                y = e.y === undefined ? e.clientY : e.y;

                offsetx = x-initmouseX+oldoffsetx;
                offsety = y-initmouseY+oldoffsety;

                tmap.style.transform = 'translate(' + offsetx + 'px,' + offsety +'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + offsetx + 'px,' + offsety +'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + offsetx + 'px,' + offsety +'px) scale(' + hmap + ')';
                //refreshMap();
            }


            return false;
        },

        handlezoom = function(e,t,ct){
            if(e.changedTouches && e.touches.length > 1){
                var xdiff1 = e.touches[0].clientX;
                var xdiff2 = e.touches[1].clientX;
                var ydiff1 = e.touches[0].clientY;
                var ydiff2 = e.touches[1].clientY;

                var xdiff = Math.abs(xdiff1 - xdiff2);
                var ydiff = Math.abs(ydiff1 - ydiff2);
                //zoom
                if (xdiff > diffx &&  ydiff > diffy){
                    hmap+= _zoom;
                }

                if (xdiff < diffx &&  ydiff < diffy){
                    hmap-= _zoom;
                }


                hmap = hmap > zmax ? zmax : hmap;
                hmap = hmap < zmin ? zmin : hmap;

                tmap.style.transform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';

                getScalefromZoom();
                refreshMap();

                diffx = xdiff;
                diffy = ydiff;

            }

            return false;
        },

        handletouchstart = function(e,t,ct){
            mapenable = true;
            if(!hasAclass('instruct','nodisplay')) addAclass('instruct','nodisplay');
            // zoom touch
            if(e.changedTouches && e.touches.length == 2){
                var xdiff1 = e.touches[0].clientX;
                var xdiff2 = e.touches[1].clientX;
                var ydiff1 = e.touches[0].clientY;
                var ydiff2 = e.touches[1].clientY;
                diffx = Math.abs(xdiff1 - xdiff2);
                diffy = Math.abs(ydiff1 - ydiff2);
                manageEvents.listenerRemove('contmap','touchmove',true);
                manageEvents.listenerAdd('contmap','touchmove', handlezoom, true);
                return false;
            }

            // > 2 touch : rien
            if(e.changedTouches && e.touches.length > 2){
                return false;
            }

            var x,y;

            if(e.changedTouches && e.touches.length == 1){
                x = e.changedTouches[0].clientX;
                y = e.changedTouches[0].clientY;
                //manageEvents.listenerAdd('contmap','touchmove', movemap, true);
                manageEvents.listenerAdd('contmap','touchmove', movemap, true);

                initmouseX = x;
                initmouseY = y;
                tmap.style.transform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
            }

            return false;
        },

        mousehdown = function(e,t,ct){

            //firstClic = 1;
            var x,y;
            if(!hasAclass('instruct','nodisplay')) addAclass('instruct','nodisplay');
            // pas touch
            if(!e.changedTouches){
                x = e.x === undefined ? e.clientX : e.x;
                y = e.y === undefined ? e.clientY : e.y;

            }

            var tt = tmap.getBoundingClientRect();
            if(tt.width/2 < window.innerWidth && tt.height < window.innerHeight ) {
                initmouseX = x;
                initmouseY = y;
                mapenable = true;
                return false;
            }

            mapenable = true;
            initmouseX = x;
            initmouseY = y;
            tmap.style.transform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
            tmap.style.msTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
            tmap.style.WebkitTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
            manageEvents.listenerAdd('contmap','mousemove', movemap, true);
            return false;
        },

        handleup = function(e,t,ct){
            mapenable = false;
            manageEvents.listenerRemove('contmap','mousemove', true);
            manageEvents.listenerRemove('contmap','touchmove', true);
            //addAclass('blocking','nodisplay');
            // > 2 touch : rien
            if(e.changedTouches && e.touches.length > 1){
                return false;
            }

            diffx = diffy = 0;

            oldoffsetx = offsetx;
            oldoffsety = offsety;

            // pour firefox
            //if(!e.changedTouches){
                //var x,y;
                //x = e.x === undefined ? e.clientX : e.x;
                //y = e.y === undefined ? e.clientY : e.y;
                /*
                if(Math.abs(x - initmouseX) < 10 || Math.abs(y - initmouseY) < 10){
                    manageEvents.listenerRemove('contmap','mousemove', true);
                    //manageEvents.listenerRemove('contmap','mousemove', true);
                    //manageEvents.listenerRemove('contmap','touchmove');
                }
                */

            //}


            centerVertical();

            return false;

        },

        centerVertical = function(){

            var tt = tmap.getBoundingClientRect();

            // recalage de la map au milieu
            if(tt.height < window.innerHeight){
                oldoffsety = offsety = (window.innerHeight - _htmap)/2;
                addAclass('twomaps','transmapb');
                manageEvents.listenertransAdd('twomaps', 'transitionend', transend2);
                tmap.style.transform = 'translate(' + oldoffsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + oldoffsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + oldoffsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                return false;
            }

            // recalage de la map en haut
            if(tt.top > 0){
                oldoffsety = offsety = ((_htmap*hmap)-_htmap)/2;
                addAclass('twomaps','transmapb');
                manageEvents.listenertransAdd('twomaps', 'transitionend', transend2);
                tmap.style.transform = 'translate(' + oldoffsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + oldoffsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + oldoffsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                //refreshMap();
            }

            // recalage de la map en bas
            if(tt.bottom < window.innerHeight){
                oldoffsety = offsety = window.innerHeight - ((_htmap*hmap)+_htmap)/2;
                addAclass('twomaps','transmapb');
                manageEvents.listenertransAdd('twomaps', 'transitionend', transend2);
                tmap.style.transform = 'translate(' + oldoffsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + oldoffsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + oldoffsetx + 'px, ' + offsety +'px) scale(' + hmap + ')';

            }

        },

        manualZoomd = function(e, t, ct){

            if(!hasAclass('instruct','nodisplay')) addAclass('instruct','nodisplay');

            var id = t.getAttribute('id');

            interzoom = setInterval(function(){
                hmap = id == 'zplus' ? hmap + _zoom : hmap - _zoom;
                hmap = hmap > zmax ? zmax : hmap;
                hmap = hmap < zmin ? zmin : hmap;
                tmap.style.transform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
                getScalefromZoom();
                //refreshMap();
            },100);

            return false;
        },

        manualZoomu = function(e, t, ct){

            refreshMap();
            clearInterval(interzoom);

            return false;
        },

        wheelMouse = function(e, t, ct){
            if(!hasAclass('instruct','nodisplay')) addAclass('instruct','nodisplay');
            var delta = Math.max(-1, Math.min(1, e.deltaY));
            if(delta == -1){
                hmap+=.1;
            }
            if(delta == 1){
                hmap-=.1;
            }
            hmap = hmap > zmax ? zmax : hmap;
            hmap = hmap < zmin ? zmin : hmap;
            tmap.style.transform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
            tmap.style.msTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';
            tmap.style.WebkitTransform = 'translate(' + oldoffsetx + 'px,' + oldoffsety +'px) scale(' + hmap + ')';

            getScalefromZoom();

            refreshMap();
        },

        reSize = function (e,t,ct){
            initSlider();
            /*
            if(firstClic == 0) {
                //centerMap();
            }else{

            }*/
            if(started == 1) refreshMap();
        },

        afterMinuterie = function(){
            addAclass('minutes','fadeout');
            addAclass('skip','fadein');
        },

        transend = function(e,t,ct){
            removeAclass('twomaps','transmap');
            removeAclass('instruct','instzero');
            addAclass('mapa','vawes');
            addAclass('mapb','vawes');
            manageEvents.listenerRemove('twomaps', 'transitionend');
        },

        transend2 = function(e,t,ct){
            removeAclass('twomaps','transmapb');
            manageEvents.listenerRemove('twomaps', 'transitionend');
        },

        transend3 = function(e,t,ct){
            removeAclass('twomaps','transmap');
            refreshMap();
            centerVertical();
            addAclass('mapa','vawes');
            addAclass('mapb','vawes');
            manageEvents.listenerRemove('twomaps', 'transitionend');
        },

        clicthmb = function(e,t,ct){
            var lien = t.getAttribute('href');
            var typ = t.getAttribute('data-type');
            switch(typ){
                case 'images':
                    $ID('affiche').src = '_img/' + lang + '/bts/big/' + lien + '.jpg';
                break;
                case 'youtube':
                    removeAclass('btsvideo','nodisplay');
                    window.player2.loadVideoById(lien);
                    addAclass('blocg','novisible');
                    addAclass('blocd','novisible');
                    addAclass('soon','novisible');
                break;
                case 'playlist':
                  // redirection direct sur click
                break;
            }
            return false;
        },

        displayBTS = function(i,ap){ // ap = autoplay (premier lancement)
            var ret = '<ul id="sliding">';
            var rep = i == 0 ? 'lite/' : i == 1 ? 'thumbvid/' : 'thumbplst/';
            var clas = i == 0 ? 'trois' : i == 1 ? 'deux' : 'trois';
            var typ = i == 0 ? 'images' : i == 1 ? 'youtube' : 'playlist';
            var tag = '';

            removeAclass('thimg','sel');
            removeAclass('thvideo','sel');
            removeAclass('thplst','sel');

            var arrow = '';

            if(i == 0) { addAclass('thimg','sel'); tag = 'ga-thimg-';}    // images
            if(i == 1) { addAclass('thvideo','sel'); tag = 'ga-thvideo-'; arrow = '<img src="_img/arrow-video.png" class="arrow"/>'; }  // videos
            if(i == 2) { addAclass('thplst','sel'); tag = 'ga-thplst-';}   // playlist

            for (var t=0; t<assets[i].asset.length; t++){
                var asst = assets[i].asset[t];
                var u = '';
                if(i == 2) u = urlspotify;
                ret += '<li class="' + clas + '"><a href="' + u + asst + '" id="thmb' + t + '" data-type="' + typ + '" target="_blank">' + arrow + '<img src="_img/' + lang + '/bts/' + rep + asst + '.jpg" id="' + tag + (t+1) + '" class="fond"/></a></li>';
            }

            ret +='</ul>';
            $ID('thumb').innerHTML = '<div class="liste" id="liste">' + ret + '<div id="gutter" class="gutter novisible"><div class="slider" id="slider"></div></div></div>';

            for (var t=0; t<assets[i].asset.length; t++){
                if(i == 2){
                    manageEvents.listenerAdd('thmb'+t,'click', clicthmb, false);
                }else{
                    manageEvents.listenerAdd('thmb'+t,'click', clicthmb, true);
                }
            }

            if(ap){
                removeAclass('btsvideo','nodisplay');
                window.player2.loadVideoById(assets[i].asset[0]);
                addAclass('blocg','novisible');
                addAclass('blocd','novisible');
                addAclass('close1','novisible');
                addAclass('closevid','novisible');
                removeAclass('skipbts','novisible');
                addAclass('share1','novisible');
                addAclass('soon','novisible');
            }

            var mm = setTimeout(function(){
                  initSlider();
              },800);
        },

        clicnothing = function(e, t, ct){
            return false;
        },

        clic = function(e, t, ct){

            var href = '';
            try{
                href = t.getAttribute('href');
            }catch(err){
                href = '';
            }

            if(href !== ''){
                switch(href){
                    case '#start':
                        started = 1;
                        for (var i = 1; i < 16; i++){
                            var id1 = 'film'+i+'a';
                            var id2 = 'film'+i+'b';
                            removeAclass(id1,'opaczero');
                            removeAclass(id2,'opaczero');
                        }
                        removeAclass('boat1','opaczero');
                        removeAclass('boat2','opaczero');
                        //addAclass('moanabig','transmo');
                        removeAclass('footermap1','novisible');
                        removeAclass('behind','novisible');
                        removeAclass('socials','novisible');
                        removeAclass('zooms','novisible');
                        addAclass('page1','novisible');
                        removeAclass('mapa','novisible');
                        removeAclass('mapb','novisible');
                        addAclass('loader','nodisplay');

                        initMaps('film11a', transend);
                    break;
                    case '#behind':
                        addAclass('behind','novisible');
                        addAclass('footermap1','novisible');
                        if(assets[1].asset[0] != ''){
                            displayBTS(1,true); // videos
                        }else{
                            if(assets[2].asset[0] != ''){
                                displayBTS(2,false); // playlists
                                addAclass('skipbts','novisible');
                            }
                        }

                        removeAclass('page7','novisible');
                        addAclass('moana2','moanafanim');
                        removeAclass('mapa','vawes');
                        removeAclass('mapb','vawes');
                        addAclass('zooms','novisible');
                        removeAclass('mapa','vawes');
                        removeAclass('mapb','vawes');
                    break;
                    case '#images':
                        displayBTS(0,false);
                    break;
                    case '#videos':
                        displayBTS(1,false);
                    break;
                    case '#playlists':
                        displayBTS(2,false);
                    break;
                    case '#closevideo':
                        //window.player2.seekTo(0);
                        window.player2.stopVideo();
                        removeAclass('blocg','novisible');
                        removeAclass('blocd','novisible');
                        addAclass('btsvideo','nodisplay');
                        removeAclass('soon','novisible');
                    break;
                    case '#suiv':
                        if(curbtsimg < assets[0].asset.length-1){
                            curbtsimg++;
                            $ID('affiche').src = '_img/' + lang + '/bts/big/' + assets[0].asset[curbtsimg] + '.jpg';
                        }
                    break;
                    case '#prec':
                        if(curbtsimg > 0){
                            curbtsimg--;
                            $ID('affiche').src = '_img/' + lang + '/bts/big/' + assets[0].asset[curbtsimg] + '.jpg';
                        }
                    break;
                    case '#continue1': // BTS
                        //var id = $ID('page7').getAttribute('id');
                        $ID('thumb').innerHTML = '';
                        addAclass('page7','novisible');
                        removeAclass('footermap1','novisible');
                        removeAclass('behind','novisible');
                        removeAclass('blocg','novisible');
                        removeAclass('blocd','novisible');
                        //window.player2.seekTo(0);
                        window.player2.pauseVideo();
                        addAclass('btsvideo','nodisplay');
                        removeAclass('moana2','moanafanim');
                        addAclass('mapa','vawes');
                        addAclass('mapb','vawes');
                        removeAclass('zooms','novisible');
                        addAclass('mapa','vawes');
                        addAclass('mapb','vawes');
                    break;
                    case '#continue2': // playlist album
                        $ID('album').innerHTML = '';
                        addAclass('albums','novisible');
                        $ID('posters').src = '_img/loading.gif';
                        removeAclass('footermap1','novisible');
                        removeAclass('behind','novisible');
                        removeAclass('moana3','moanafanim');
                        removeAclass('zooms','novisible');
                        initMaps(currentnode, transend3);

                        //audioTag.pause();
                    break;
                    case '#skip':
                        finintervideo();
                    break;
                    case '#skipbts':
                        finBTSvideo(true);
                        //window.player2.seekTo(0);
                        window.player2.pauseVideo();
                    break;
                        /*
                    case '#plus':
                        manualZoom(1);
                    break;
                    case '#moins':
                        manualZoom(-1);
                    break;
                    */
                }
            }
            return false;
        },

        clicfilms = function(e,t,ct){

            mapenable = false;

            manageEvents.listenerRemove('contmap','mousemove', true);
            manageEvents.listenerRemove('contmap','touchmove',true);

            var x,y;

            // si pas clic on zap
            if(!e.changedTouches){
                x = e.x === undefined ? e.clientX : e.x;
                y = e.y === undefined ? e.clientY : e.y;
                if(x != initmouseX || y != initmouseY){
                    return false;
                }
            }

            // si resultat d'un swipe on zap
            if(e.changedTouches){
                x = e.changedTouches[0].clientX;
                y = e.changedTouches[0].clientY;
                if(Math.abs(x - initmouseX) > 10 || Math.abs(y - initmouseY) > 10){
                    diffx = diffy = 0;
                    oldoffsetx = offsetx;
                    oldoffsety = offsety;
                    return false;
                }
            }

            var href = '';
            try{
                href = t.getAttribute('href');
            }catch(err){
                href = '';
            }

            if(href !== ''){
                switch(href){
                    case '#peterpan':
                    case '#cinderella':
                    case '#frozen':
                    case '#tangled':
                    case '#mermaid':
                    case '#pinocchio':
                    case '#aladdin':
                    case '#mulan':
                    case '#lionking':
                    case '#junglebook':
                    case '#moana':
                    case '#pocahontas':
                    case '#bighero6':
                    case '#baymax':
                    case '#frog':

                        /*
                        // en hover une fois clique
                        var num = t.getAttribute('data-num');
                        var cls = 'dejavu'+num;
                        addAclass('film'+num+'a',cls);
                        addAclass('film'+num+'b',cls);
                        */
                        removeAclass('mapa','vawes');
                        removeAclass('mapb','vawes');
                        autoplay = getVoyages();
                        curTracks = 0;
                        curSongId = 0;
                        var num = t.getAttribute('data-num');
                        var cur = t.getAttribute('id');
                        var id = t.getAttribute('data-album');
                        $ID('skip').setAttribute('data-album',id);
                        $ID('skip').setAttribute('data-ref',href);
                        $ID('skip').setAttribute('data-num',num);
                        addAclass('footermap1','novisible');
                        addAclass('behind','novisible');
                        addAclass('zooms','novisible');

                        removeAclass('albums','novisible');
                        var bx = t.getAttribute('data-bx');
                        var by = t.getAttribute('data-by');
                        $ID('boat1').style.top = by+'%';
                        $ID('boat1').style.left = bx+'%';
                        $ID('boat2').style.top = by+'%';
                        $ID('boat2').style.left = bx+'%';
                        if(autoplay) addAclass('moana3','moanafanim');
                        getAlbum(id,href,num);
                        currentnode = cur;

                    break;
                }
            }

            return false;
        },

        imgloaded = function(e, t, ct, im, tot){
            imgload++;
            //$ID('loading').style.width = Math.round((imgload/tot)*100)+'%';
            $ID('loading').style.width = Math.round((imgload/tot)*100)+'%';
            //console.log(imgload);
            //console.log(tot);
            if(imgload >= tot) {
              var mm = setTimeout(function(){
                  addAclass('loader','nodisplay');
                  clearTimeout(mm);
              },1000);

            }

        },

        // slider BTS ----------------------------------------------------------------------------------------------------

        slider = {
            'touchstarty':0,    // coord touchstart Y
            'boundlist':{},     // getBoundingClientRect() de liste
            'contH':0,          // hauteur du conteneur de la liste
            'lsty':0,           // coord Y de la liste
            'lstH':0,           // hauteur de la liste
            'gutY':0,           // coord Y du gutter    --> ascenceur
            'gutH':0,           // hauteur du gutter    --> ascenceur
            'slY':0,            // coord Y slider       --> ascenceur
            'slH':0,            // hauteur du slider    --> ascenceur
            'ulY':0,            // coord Y ul à slider
            'ulH':0,            // hauteur ul à slider
            'offY':0,           // unite decalage Y ul à slider
            'lineH':0,          // hauteur li (== offY)
            'offYd':0 ,         // division hauteur ul à slider
            'deltalist':0       // difference entre ulH - contH
        },

        initSlider = function(){
            if($ID('sliding') !== null){
                var n = $ID('sliding').childNodes.length;
                slider.contH        = $ID('liste').offsetHeight;
                slider.lstH         = $ID('liste').childNodes[0].offsetHeight;
                slider.gutH         = $ID('gutter').offsetHeight;
                slider.ulY          = $ID('sliding').offsetTop;
                slider.ulH          = $ID('sliding').offsetHeight;
                slider.lineH        = $ID('sliding').childNodes[0].offsetHeight;
                slider.offY         = slider.ulH/n;
                slider.boundlist    = $ID('liste').getBoundingClientRect();
                slider.offYd        = slider.offY/2;
                slider.deltalist    = slider.ulH-slider.contH;
                slider.slH          = slider.deltalist;

                $ID('sliding').style.transform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.transform = 'translate(0px,' + slider.ulY + 'px)';
                // ie 9
                $ID('sliding').style.msTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.msTransform = 'translate(0px,' + slider.ulY + 'px)';

                $ID('sliding').style.WebkitTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.WebkitTransform = 'translate(0px,' + slider.ulY + 'px)';

                $ID('slider').style.height = (slider.gutH-slider.slH)+'px';
                if(slider.deltalist <= 0) {
                    addAclass('gutter','novisible');
                }else{
                    removeAclass('gutter','novisible');
                }

                if(slider.contH < slider.lstH){
                    manageEvents.listenerAdd('liste','touchstart',slidetouchstart,false);
                    manageEvents.listenerAdd('liste','mousewheel',slidewheelMouse,true);
                    manageEvents.listenerAdd('liste','DOMMouseScroll',slidewheelMouse,true);
                    manageEvents.listenerAdd('liste','wheel',slidewheelMouse,true);
                    removeAclass('gutter','novisible');
                }else{
                    manageEvents.listenerRemove('liste','touchstart');
                    manageEvents.listenerRemove('liste','mousewheel');
                    manageEvents.listenerRemove('liste','DOMMouseScroll');
                    manageEvents.listenerRemove('liste','wheel');
                    if(!hasAclass('gutter','novisible')) addAclass('gutter','novisible');
                }
            }

        },

        slidetouchstart = function(e, t, ct){
            slider.touchstarty = e.touches[0].clientY;
            manageEvents.listenerAdd('liste','touchmove',slidetouchmove,true);
            manageEvents.listenerAdd('liste','touchend',slidetouchend,false);
            manageEvents.listenerAdd('liste','touchleave',slidetouchend,false);
            return false;
        },

        slidetouchmove = function(e, t, ct){
            var ytop = $ID('sliding').getBoundingClientRect().top;
            var ybott = $ID('sliding').getBoundingClientRect().bottom;

            /*
            if(ybott > slider.boundlist.bottom){
                $ID('sliding').style.transform = 'translate(0px,' + slider.ulY + 'px)'
            }
            */

            if(e.touches[0].clientY < slider.touchstarty && ybott > slider.boundlist.bottom) {
                slider.ulY -= slider.offYd;
                $ID('sliding').style.transform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.transform = 'translate(0px,' + -slider.ulY + 'px)';
            }

            if(e.touches[0].clientY > slider.touchstarty && ytop < slider.boundlist.top) {
                slider.ulY += slider.offYd;
                $ID('sliding').style.transform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.transform = 'translate(0px,' + -slider.ulY + 'px)';
            }

            if(ytop > slider.boundlist.top){
                slider.ulY = 0;
                $ID('sliding').style.transform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.transform = 'translate(0px,' + -slider.ulY + 'px)';
            }

            slider.touchstarty = e.touches[0].clientY;

            return false;
        },

        slidetouchend = function(e, t, ct){
            manageEvents.listenerRemove('liste','touchmove');
            manageEvents.listenerRemove('liste','touchend');
            manageEvents.listenerRemove('liste','touchleave');
        },

        slidewheelMouse = function(e, t, ct){
                //var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
            var delta = Math.max(-1, Math.min(1, e.deltaY));
            var ytop = $ID('sliding').getBoundingClientRect().top;
            var ybott = $ID('sliding').getBoundingClientRect().bottom;

            if(delta == -1 && ytop > slider.boundlist.top){
                slider.ulY = 0;
                $ID('sliding').style.transform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.transform = 'translate(0px,' + -slider.ulY + 'px)';
                // ie 9
                $ID('sliding').style.msTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.msTransform = 'translate(0px,' + -slider.ulY + 'px)';

                $ID('sliding').style.WebkitTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.WebkitTransform = 'translate(0px,' + -slider.ulY + 'px)';
                return false;
            }

            if(delta == 1 && ybott <= slider.boundlist.bottom-slider.offYd){
                slider.ulY = -slider.deltalist;//slider.contH - slider.lstH;
                $ID('sliding').style.transform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.transform = 'translate(0px,' + -slider.ulY + 'px)';
                // ie 9
                $ID('sliding').style.msTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.msTransform = 'translate(0px,' + -slider.ulY + 'px)';

                $ID('sliding').style.WebkitTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.WebkitTransform = 'translate(0px,' + -slider.ulY + 'px)';
                return false;
            }

            if(delta == 1 && ybott >= slider.boundlist.bottom) {
                slider.ulY -= slider.offYd;
                $ID('sliding').style.transform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.transform = 'translate(0px,' + -slider.ulY + 'px)';
                // ie 9
                $ID('sliding').style.msTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.msTransform = 'translate(0px,' + -slider.ulY + 'px)';

                $ID('sliding').style.WebkitTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.WebkitTransform = 'translate(0px,' + -slider.ulY + 'px)';
            }

            if(delta == -1 && ytop < slider.boundlist.top) {
                slider.ulY += slider.offYd;
                $ID('sliding').style.transform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.transform = 'translate(0px,' + -slider.ulY + 'px)';
                // ie 9
                $ID('sliding').style.msTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.msTransform = 'translate(0px,' + -slider.ulY + 'px)';

                $ID('sliding').style.WebkitTransform = 'translate(0px,' + slider.ulY + 'px)';
                $ID('slider').style.WebkitTransform = 'translate(0px,' + -slider.ulY + 'px)';
            }

            return false;
        },

        shareFB = function(e,t,ct){
            var w = 600, h = 400,
            t = window.innerHeight/2-h/2, l = window.innerWidth/2-w/2;
            window.open(urlfb, 'facebook', 'width=600, height=400, top=' + t + ', left=' + l +  ' scrollbars=no');
            return false;
        }

        // FIN slider BTS -----------------------------------------------------------------------------------------------

        // ORIENTATION

        manageEvents.listenerAdd(window,'orientationchange', function(e,t,ct){

            if(started == 0 && window.innerWidth > window.innerHeight && ochanged == 0 ){
                tmap = $ID('twomaps');
                map1 = $ID('mapa');
                map2 = $ID('mapb');
                map1.style.top = '0px';
                map2.style.top = '0px';
                map1.style.left = '0px';
                map2.style.left = xmap2 + 'px';
                var moa = $ID('film11a').getBoundingClientRect();
                var imapa = map1.getBoundingClientRect();

                oldoffsetx = offsetx = ((window.innerWidth/2 - moa.left)*hmap)-moa.width/2;
                oldoffsety = offsety = -(moa.top+imapa.top)*hmap+window.innerHeight/2;
                hmap = 1.2;
                tmap.style.transform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                ochanged = 1;
            };

            window.player1.pauseVideo();
            window.player2.pauseVideo();

            var orientation = t.orientation;
           if (orientation !== undefined){
                var ort = setTimeout(function(){
                    var wnw = window.innerWidth;
                    var scrw = screen.width;
                    var scrh = screen.height;
                    var wnh = window.innerHeight;
                    if(wnw > wnh){
                        if(scrh > scrw) scrh = scrw;
                        var offset = scrh - wnh;
                        document.body.style.height = scrh+'px';
                        setTimeout( function(){
                            window.scrollTo(0,0);
                        }, 10 );

                    };
                },300);
            };


        })

        // EVENTS

        manageEvents.listenerAdd(document,'DOMContentLoaded', function(e,t,ct){


            manageEvents.ImageLoader.listenerAdd('img','load', imgloaded, true);

            tmap = $ID('twomaps');
            map1 = $ID('mapa');
            map2 = $ID('mapb');

            manageEvents.listenerAdd('contmap','touchstart', handletouchstart, true);
            manageEvents.listenerAdd('contmap','mousedown', mousehdown, true);
            manageEvents.listenerAdd('contmap','touchend', handleup, false);
            manageEvents.listenerAdd('contmap','mouseup', handleup, true);
           // manageEvents.listenerAdd('contmap','click', clicmap, true);
            manageEvents.listenerAdd('contmap','mousewheel',wheelMouse, false);
            manageEvents.listenerAdd('contmap','DOMMouseScroll',wheelMouse, false);
            manageEvents.listenerAdd('contmap','wheel', wheelMouse, false);

            manageEvents.listenerAdd(window,'resize', reSize, true);

            manageEvents.listenerAdd('start','click', clic, true);
            manageEvents.listenerAdd('behind','click', clic, true);

            manageEvents.listenerAdd('thimg','click', clic, true);
            manageEvents.listenerAdd('thvideo','click', clic, true);
            manageEvents.listenerAdd('thplst','click', clic, true);

            manageEvents.listenerAdd('prec','click', clic, true);
            manageEvents.listenerAdd('suiv','click', clic, true);

            //manageEvents.listenerAdd('continue1','click', clic, true);
            manageEvents.listenerAdd('close1','click', clic, true);
            manageEvents.listenerAdd('continue2','click', clic, true);
            manageEvents.listenerAdd('close2','click', clic, true);

            manageEvents.listenerAdd('closevid','click', clic, true);

            manageEvents.listenerAdd('skip','click', clic, true);
            manageEvents.listenerAdd('skipbts','click', clic, true);


            manageEvents.listenerAdd('zplus','click', clicnothing, true);
            manageEvents.listenerAdd('zmin','click', clicnothing, true);

            manageEvents.listenerAdd('zplus','mousedown', manualZoomd, true);
            manageEvents.listenerAdd('zmin','mousedown', manualZoomd, true);

            manageEvents.listenerAdd('zplus','touchstart', manualZoomd, true);
            manageEvents.listenerAdd('zmin','touchstart', manualZoomd, true);

            manageEvents.listenerAdd('zplus','mouseup', manualZoomu, true);
            manageEvents.listenerAdd('zmin','mouseup', manualZoomu, true);

            manageEvents.listenerAdd('zplus','touchend', manualZoomu, true);
            manageEvents.listenerAdd('zmin','touchend', manualZoomu, true);

            manageEvents.listenerAdd('share1','click', shareFB, true);
            manageEvents.listenerAdd('share2','click', shareFB, true);
            manageEvents.listenerAdd('share3','click', shareFB, true);



            //centrage de la map avec un zoom
            if (window.innerWidth > window.innerHeight){
                var moa = $ID('film11a').getBoundingClientRect();
                var imapa = map1.getBoundingClientRect();
                map1.style.left = '0px';
                map2.style.left = xmap2 + 'px';
                oldoffsetx = offsetx = ((window.innerWidth/2 - moa.left)*hmap)-moa.width/2;
                oldoffsety = offsety = -(moa.top+imapa.top)*hmap+window.innerHeight/2;
                hmap = 1.2;
                tmap.style.transform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                tmap.style.msTransform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                tmap.style.WebkitTransform = 'translate(' + offsetx + 'px,' + offsety + 'px) scale(' + hmap + ')';
                ochanged = 1;
            }


            for (var i = 1; i < 16; i++){
                var id1 = 'film'+i+'a';
                var id2 = 'film'+i+'b';

                manageEvents.listenerAdd(id1, 'click', clicfilms, true);
                manageEvents.listenerAdd(id2, 'click', clicfilms, true);

                manageEvents.listenerAdd(id1, 'touchend', clicfilms, true);
                manageEvents.listenerAdd(id2, 'touchend', clicfilms, true);
            }

        },true);

        // function exposed
        window.startlevelTimer = startlevelTimer;
        window.afterMinuterie = afterMinuterie;
        window.finintervideo = finintervideo;
        window.finBTSvideo = finBTSvideo;

       // effacement données globales
       window.albums = null;
       window.assets = null;
       //window.token = null;
       window.lang = null;
       window.urlspt = null;
       window.voyages = null;
       window.msgsoon = null;
       window.urlfb = null;
       window.rep = null;
       window.moana = null;
    // end closure
    })();

    </script>
</body>
</html>
