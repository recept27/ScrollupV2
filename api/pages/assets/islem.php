<?php

// Create the object.
$gameScore = new ParseObject("GameScore");

$gameScore->set("score", 1337);
$gameScore->set("playerName", "Sean Plott");
$gameScore->set("cheatMode", false);
$gameScore->setArray("skills", ["pwnage", "flying"]);

$gameScore->save();
// Now let's update it with some new data. In this case, only cheatMode and score
// will get sent to the cloud. playerName hasn't changed.
$gameScore->set("cheatMode", true);
$gameScore->set("score", 1338);
$gameScore->save();








?>