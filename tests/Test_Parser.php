<?php

include '../library/Parser.php';

$examples = array(
    array('echo $a',
        array('echo $a')),
    array('echo \'\' > cat',
        array('echo \'\' ', '> cat')),
    array('echo \'\' >> cat',
        array('echo \'\' ', '>> cat')),
    array('a=\'asdf\'; echo $a',
        array('a=\'asdf\'', '; echo $a')),
    array('cat 2> asdf.txt',
        array('cat ', '2> asdf.txt')),
    array('echo hola\ mundo',
        array('echo hola\\ mundo')),
    array('touch \<asdf\>',
        array('touch <asdf>')),
    array('find . -type f -name \'*.php\' | xargs grep -i \'asdf\'',
        array('find . -type f -name \'*.php\' ', '| xargs grep -i \'asdf\'')),
    array('find . -type f -name \'*.php\' | xargs grep -i \'asdf\' 2>> af.txt',
        array('find . -type f -name \'*.php\' ',
            '| xargs grep -i \'asdf\' ',
            '2>> af.txt')),
);

foreach ($examples as $i => $example) {
    $result = Parser::parseInstruction($example[0]);
    $expected = $example[1];
    
    $equals = count($result) == count($expected);
    for ($j = 0; $j < count($result); $j++) {
        $equals &= ($result[$j] === $expected[$j]);
    }
    
    echo ($equals) ? 'yes:test ' : 'failed:test';
    echo $i;
    echo PHP_EOL;
    echo ' =>   ';
    echo implode('', $result);
    echo PHP_EOL;
    echo ' =>   ';
    echo implode('', $expected);
    echo PHP_EOL;
}
