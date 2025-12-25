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
        $x = 0;                   // начальное значение аргумента
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

        $cycle_type = 1; // 1 - for с break, 2 - while, 3 - do-while

        if ($cycle_type == 1) {
            //заданное количество итераций
            for( $i=0; $i < $encounting; $i++, $x+=$step )
            {
                // вычисление значения функции
                if( $x <= 10 )         
                {
                    if( $x == 0 )      // если аргумент равен 0 (деление на ноль)
                        $f = 'error';  // не вычисляем
                    else{              
                        $f = (10 + $x) / $x;  // вычисляем
                        $f = round($f, 3);
                    }
                }
                else                   
                if( $x < 20 )          
                {
                    $f = $x / 7 * ($x - 2);   // вычисляем
                    $f = round($f, 3);
                }
                else                   // иначе (x ≥ 20)
                {
                    $f = $x * 8 + 2;   // вычисляем
                    $f = round($f, 3);
                }
                
                // проверка на выход за пределы диапазона
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
        }
        elseif ($cycle_type == 2) {
            // while с предусловием
            $i = 0;
            $x = 0; // сбрасываем аргумент
            while ($i < $encounting) {
                // вычисление значения функции
                if( $x <= 10 ) {
                    if( $x == 0 ) {
                        $f = 'error';
                    } else {              
                        $f = (10 + $x) / $x;
                        $f = round($f, 3);
                    }
                } elseif( $x < 20 ) {
                    $f = $x / 7 * ($x - 2);
                    $f = round($f, 3);
                } else {
                    $f = $x * 8 + 2;
                    $f = round($f, 3);
                }
                
                // проверка на выход за пределы диапазона
                if ($f != 'error' && ($f >= $max_value || $f < $min_value)) {
                    break;
                }
                
                // вывод в зависимости от типа верстки
                switch ($type) {
                    case 'A':
                        echo 'f(' . $x . ')=' . $f;
                        if ($i < $encounting - 1) {
                            echo '<br>';
                        }
                        break;
                    case 'B':
                    case 'C':
                        echo '<li>f(' . $x . ')=' . $f . '</li>';
                        break;
                    case 'D':
                        $row_num = $i + 1;
                        echo '<tr>';
                        echo '<td style="border: 1px solid black; text-align: center;">' . $row_num . '</td>';
                        echo '<td style="border: 1px solid black; text-align: center;">' . $x . '</td>';
                        echo '<td style="border: 1px solid black; text-align: center;">' . $f . '</td>';
                        echo '</tr>';
                        break;
                    case 'E':
                        echo '<div style="float: left; border: 2px solid red; margin: 8px; padding: 5px;">';
                        echo 'f(' . $x . ')=' . $f;
                        echo '</div>';
                        break;
                }
                
                // сбор статистики
                if( $f != 'error' ) {
                    $sum += $f;
                    $count++;
                    if( $f < $min_f ) $min_f = $f;
                    if( $f > $max_f ) $max_f = $f;
                }
                
                 $i++;
                 $x += $step;
            }
        }
        else {
            // do-while с постусловием
            $i = 0;
            $x = 0; // сбрасываем аргумент
            do {
                // вычисление значения функции
                if( $x <= 10 ) {
                    if( $x == 0 ) {
                        $f = 'error';
                    } else {              
                        $f = (10 + $x) / $x;
                        $f = round($f, 3);
                    }
                } elseif( $x < 20 ) {
                    $f = $x / 7 * ($x - 2);
                    $f = round($f, 3);
                } else {
                    $f = $x * 8 + 2;
                    $f = round($f, 3);
                }
                
                // проверка на выход за пределы диапазона
                if ($f != 'error' && ($f >= $max_value || $f < $min_value)) {
                    break;
                }
                
                // вывод в зависимости от типа верстки
                switch ($type) {
                    case 'A':
                        echo 'f(' . $x . ')=' . $f;
                        if ($i < $encounting - 1) {
                            echo '<br>';
                        }
                        break;
                    case 'B':
                    case 'C':
                        echo '<li>f(' . $x . ')=' . $f . '</li>';
                        break;
                    case 'D':
                        $row_num = $i + 1;
                        echo '<tr>';
                        echo '<td style="border: 1px solid black; text-align: center;">' . $row_num . '</td>';
                        echo '<td style="border: 1px solid black; text-align: center;">' . $x . '</td>';
                        echo '<td style="border: 1px solid black; text-align: center;">' . $f . '</td>';
                        echo '</tr>';
                        break;
                    case 'E':
                        echo '<div style="float: left; border: 2px solid red; margin: 8px; padding: 5px;">';
                        echo 'f(' . $x . ')=' . $f;
                        echo '</div>';
                        break;
                }
                
                // сбор статистики
                if( $f != 'error' ) {
                    $sum += $f;
                    $count++;
                    if( $f < $min_f ) $min_f = $f;
                    if( $f > $max_f ) $max_f = $f;
                }
                
                
                $i++;
                $x += $step;
            } while ($i < $encounting);
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