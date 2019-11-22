<?php
$first = ["Daniel", "Juan", "Jose", "Ignacio", "Nacho", "Chucho", "Fifi", "Asies", "Carlos", "Jojo", "Petra", "Ana", "Carla", "Luis", "Kobe", "Maya", "Maja", "Luna", "Pepitas", "Gonzo", "Che", "Jumbo", "Schrodinger", "Newmman", "Carlí", "Aries", "Carlo", "Magno", "Marco", "Polo", "Asus", "Fifa", "Paula", "Hammlet", "Porqui", "Titán", "Tintan", "Cantinflas", "Buches", "Nana", "Pancha", "Concha", "Julia", "Tunas", "Agüite"];
$second = ["Ángel", "Miguel", "Rufus", "Chiquilin", "Chilaquil", "Eduardo", "Babas", "Chuleta", "Carnes", "Fino", "Joncho", "Frufrú", "Guanso", "Balto", "Rucky", "Cronck", "Crush", "Narizes", "Manchas", "Jack", "Popochas", "Chicarcas", "Milaneso", "Firulais", "Longaniza", "Froyd", "Aguas", "Locote", "Ajocote", "Filero", "Kevin", "Brayatan", "Romina", "Chumacero", "Orvelin", "Odin", "Aries", "Papastopulus", "Mark", "Twain", "Roca", "Chirs", "Chase", "Tuntún"];
$last = ["Alfonso", "López", "Gómez", "Pérez", "Cristobal", "Roethlisberger", "Días", "Jaramillo", "Contreras", "Chacón", "Buches", "Chamorro", "Torres", "Juriquilla", "Calamidad", "Gonzalo", "Perengano", "Salsas", "Leal", "Bravo", "Ochocinco", "Polamalu", "Bellamy", "Aristemo", "Dominic", "Toreto", "Walker", "Funesgoli", "Duolingo", "Perry", "Katie", "Sofos", "Gordoñes", "Casas", "Cuevas", "Reyes", "Almirante", "Navegante", "Foreman", "House", "Tarantulino"];
$last2 = ["Euralio", "Castillo", "Del Castillo", "Pérez", "Textex", "Julián", "Casablancas", "Matadamas", "Culiacán", "Del Rosario", "Rosario", "Navajas", "Tijeras", "Piedra", "Mata", "Mota", "Calderón", "Inojosa", "Peña", "Obrador", "Chica", "Niño", "Jirafifita", "Rinoceronte", "Brutus", "Esteban", "Arce", "Kronos", "Zeus", "Comandante", "Soledad", "Capitan", "Amoroso", "Perezoso", "Carroñero", "Combatiente", "Maestro", "Tripulante", "Dracula", "Chinchin"];
// echo count($first)." ".count($second)." ".count($last)." ".count($last2);
for($i = 0; $i < 200000; $i++) {
    $f = rand(0,44);
    $s = rand(0,43);
    $l = rand(0,40);
    $l2 = rand(0,39);
    echo $first[$f]." ".$second[$s]." ".$last[$l]." ".$last2[$l2]."\n";
}