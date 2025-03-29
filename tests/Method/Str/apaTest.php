<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class apaTest extends TestCase
{
    function test()
    {
        $this->assertSame('Tom and Jerry', Str::apa('tom and jerry'));
        $this->assertSame('Tom and Jerry', Str::apa('TOM AND JERRY'));
        $this->assertSame('Tom and Jerry', Str::apa('Tom And Jerry'));

        $this->assertSame('Back to the Future', Str::apa('back to the future'));
        $this->assertSame('Back to the Future', Str::apa('BACK TO THE FUTURE'));
        $this->assertSame('Back to the Future', Str::apa('Back To The Future'));

        $this->assertSame('This, Then That', Str::apa('this, then that'));
        $this->assertSame('This, Then That', Str::apa('THIS, THEN THAT'));
        $this->assertSame('This, Then That', Str::apa('This, Then That'));

        $this->assertSame('Bond. James Bond.', Str::apa('bond. james bond.'));
        $this->assertSame('Bond. James Bond.', Str::apa('BOND. JAMES BOND.'));
        $this->assertSame('Bond. James Bond.', Str::apa('Bond. James Bond.'));

        $this->assertSame('Self-Report', Str::apa('self-report'));
        $this->assertSame('Self-Report', Str::apa('Self-report'));
        $this->assertSame('Self-Report', Str::apa('SELF-REPORT'));

        $this->assertSame('As the World Turns, So Are the Days of Our Lives', Str::apa('as the world turns, so are the days of our lives'));
        $this->assertSame('As the World Turns, So Are the Days of Our Lives', Str::apa('AS THE WORLD TURNS, SO ARE THE DAYS OF OUR LIVES'));
        $this->assertSame('As the World Turns, So Are the Days of Our Lives', Str::apa('As The World Turns, So Are The Days Of Our Lives'));

        $this->assertSame('To Kill a Mockingbird', Str::apa('to kill a mockingbird'));
        $this->assertSame('To Kill a Mockingbird', Str::apa('TO KILL A MOCKINGBIRD'));
        $this->assertSame('To Kill a Mockingbird', Str::apa('To Kill A Mockingbird'));

        $this->assertSame('Être Écrivain Commence par Être un Lecteur.', Str::apa('Être écrivain commence par être un lecteur.'));
        $this->assertSame('Être Écrivain Commence par Être un Lecteur.', Str::apa('Être Écrivain Commence par Être un Lecteur.'));
        $this->assertSame('Être Écrivain Commence par Être un Lecteur.', Str::apa('ÊTRE ÉCRIVAIN COMMENCE PAR ÊTRE UN LECTEUR.'));

        $this->assertSame("C'est-à-Dire.", Str::apa("c'est-à-dire."));
        $this->assertSame("C'est-à-Dire.", Str::apa("C'est-à-Dire."));
        $this->assertSame("C'est-à-Dire.", Str::apa("C'EsT-À-DIRE."));

        $this->assertSame('Устное Слово – Не Воробей. Как Только Он Вылетит, Его Не Поймаешь.', Str::apa('устное слово – не воробей. как только он вылетит, его не поймаешь.'));
        $this->assertSame('Устное Слово – Не Воробей. Как Только Он Вылетит, Его Не Поймаешь.', Str::apa('Устное Слово – Не Воробей. Как Только Он Вылетит, Его Не Поймаешь.'));
        $this->assertSame('Устное Слово – Не Воробей. Как Только Он Вылетит, Его Не Поймаешь.', Str::apa('УСТНОЕ СЛОВО – НЕ ВОРОБЕЙ. КАК ТОЛЬКО ОН ВЫЛЕТИТ, ЕГО НЕ ПОЙМАЕШЬ.'));

        $this->assertSame('', Str::apa(''));
        $this->assertSame('   ', Str::apa('   '));
    }
}
