<?php

$tags = array();
foreach ($this->tags as $tag) {
    $tags[] = '<a href="' . Y::url('/tags/view', array('slug' => $tag->slug)) . '">' . $tag->name . '</a>';
}
$tags = implode(', ', $tags);

echo $tags;