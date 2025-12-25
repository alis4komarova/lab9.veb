<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа 9 - Комарова Алиса Алексеевна - Группа 241-361 - Вариант 2</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-content">
            <img src="logo.png" 
                 alt="Логотип университета" 
                 class="university-logo">
            <div class="header-info">
                <ul>
                <li>Лабораторная работа №9</li>
                <li>Выполнила: Комарова Алиса Алексеевна</li>
                <li>Группа: 241-361</li>
                <li>Вариант: 2</li>
            </ul>
            </div>
        </div>
    </header>

    <main>
        <?php
        // инициализация числовых переменных
        $x = -10;                   // начальное значение аргумента
        $encounting = 10000;       // количество вычисляемых значений
        $step = 2;                 // шаг изменения аргумента
        $min_value = -100;           // минимальное значение, останавливающее вычисления
        $max_value = 100;           // максимальное значение, останавливающее вычисления

        // инициализация строковой переменной
        $type = 'A';               // тип формируемой верстки

        // дополнительные переменные для статистики
        $sum = 0;                  // сумма значений функции
        $count = 0;                // количество вычисленных значений
        $min_f = INF;              // минимальное значение функции
        $max_f = -INF;             // максимальное значение функции

        if( $type == 'B' )         // если тип верстки В
            echo '<ul>';           // начинаем список
        if( $type == 'C' ) 
            echo '<ol>';
        if( $type == 'D' ) {
            echo '<table style="border-collapse: collapse; border: 1px solid black;">';
            echo '<tr><th style="border: 1px solid black;">№</th><th style="border: 1px solid black;">x</th><th style="border: 1px solid black;">f(x)</th></tr>';
        }
        if( $type == 'E' ) 
            echo '<div style="overflow: hidden;">';

        // цикл с заданным количеством итераций
        for( $i=0; $i < $encounting; $i++, $x+=$step )
        {
            // вычисление значения функции согласно варианту 2
            if( $x <= 10 )         // если аргумент меньше или равен 10
            {
                if( $x == 0 )      // если аргумент равен 0 (деление на ноль)
                    $f = 'error';  // не вычисляем функцию
                else{              // иначе
                    $f = (10 + $x) / $x;  // вычисляем функцию: (10+x)/x
                    $f = round($f, 3);
                }
            }
            else                   // иначе
            if( $x < 20 )          // если аргумент меньше 20
            {
                $f = $x / 7 * ($x - 2);   // вычисляем функцию: x/7*(x-2)
                $f = round($f, 3);
            }
            else                   // иначе (x ≥ 20)
            {
                $f = $x * 8 + 2;   // вычисляем функцию: x*8+2
                $f = round($f, 3);
            }
            
            // проверка на выход за пределы диапазона (если значение не 'error')
            if( $f != 'error' )
            {
                if( $f >= $max_value || $f < $min_value )  // если вышли за рамки диапазона
                    break;                                 // закончить цикл досрочно
            }
            
            // вывод в зависимости от типа верстки
            switch ($type) {
                case 'A': // простая верстка текстом
                    echo 'f(' . $x . ')=' . $f;
                    if ($i < $encounting - 1) { // если это не последняя итерация цикла
                        echo '<br>';            // выводим знак перевода строки
                    }
                    break;

                case 'B': // маркированный список
                case 'C': //нумерованный список
                    echo '<li>f(' . $x . ')=' . $f . '</li>';
                    break;

                case 'D': // табличная верстка
                    $row_num = $i + 1;
                    echo '<tr>';
                    echo '<td style="border: 1px solid black; text-align: center;">' . $row_num . '</td>';
                    echo '<td style="border: 1px solid black; text-align: center;">' . $x . '</td>';
                    echo '<td style="border: 1px solid black; text-align: center;">' . $f . '</td>';
                    echo '</tr>';
                    break;

                case 'E': // блочная верстка
                    echo '<div style="float: left; border: 2px solid red; margin: 8px; padding: 5px;">';
                    echo 'f(' . $x . ')=' . $f;
                    echo '</div>';
                    break;
            }
            
            // сбор статистики (только для числовых значений)
            if( $f != 'error' )
            {
                $sum += $f;
                $count++;
                if( $f < $min_f ) $min_f = $f;
                if( $f > $max_f ) $max_f = $f;
            }
        }

        // завершение вывода в зависимости от типа верстки
        switch ($type) {
            case 'B': // маркированный список
                echo '</ul>';
                break;
            case 'C': // нумерованный список
                echo '</ol>';
                break;
            case 'D': // табличная верстка
                echo '</table>';
                break;
            case 'E': // блочная верстка
                echo '</div>'; // закрываем контейнер для обтекания
                break;
        }

        // вывод статистики
        echo '<br><br>Статистика:<br>';
        echo 'Максимальное значение функции: '.$max_f.'<br>';
        echo 'Минимальное значение функции: '.$min_f.'<br>';
        echo 'Среднее арифметическое: '.($count > 0 ? round($sum/$count, 3) : 0).'<br>';
        echo 'Сумма значений: '.round($sum, 3).'<br>';
        ?>
    </main>

    <footer>
        <div class="footer-content">
            Тип верстки: <?php echo $type; ?>
        </div>
    </footer>
</body>
</html>