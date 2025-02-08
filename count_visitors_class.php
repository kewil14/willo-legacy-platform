<?php
/************************************************************************
Counter & visitor statistics version 2.01 -
Easy to use system to track users and visitor statistics

Copyright (C) 2004 - 2005 by Olaf Lederer

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

_________________________________________________________________________
available at http://www.finalwebsites.com
Comments & suggestions: http://www.finalwebsites.com/contact.php

Updates:
version 2.0 - Please read the documentation file about all new features.

version 2.01 - I forgot to remove an old variable: $remote_adr, this var
is replaced by $_SERVER['REMOTE_ADDR']. The error will not occur anymore.
 *************************************************************************/
error_reporting(E_ALL);
include("./config.php");

class Count_visitors {

    var $table_name = DB_TABLE;
    var $referer;
    var $delay = 1;

    // niet vergeten visits ouder dan een jaar te verwijderen
    function Count_visitors() {
        $this->referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "";
        $this->db_connect();
    }
    function db_connect() {
        mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
        mysql_select_db(DB_NAME);
    }
    function check_last_visit()
    {

        $pdo = new PDO('mysql:host=ojrh.myd.infomaniak.com;dbname=ojrh_willo', 'ojrh_RAD', '23564092R');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $check_sql = "SELECT time + 0 FROM {$this->table_name} WHERE visit_date = CURDATE() AND ip_adr = :ip_adr ORDER BY time DESC LIMIT 0, 1";
        $stmt = $pdo->prepare($check_sql);
        $stmt->execute(['ip_adr' => $_SERVER['REMOTE_ADDR']]);
        $check_row = $stmt->fetch(PDO::FETCH_NUM);
        if ($stmt->rowCount() != 0) {
            $last_hour = date("H") - $this->delay;
            $check_time = date($last_hour . "is");
            if ($check_row[0] < $check_time) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
    function get_country() {

        $pdo = new PDO('mysql:host=ojrh.myd.infomaniak.com;dbname=ojrh_willo', 'ojrh_RAD', '23564092R');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $country_sql = "SELECT country FROM ip2nation WHERE ip < INET_ATON(:remote_addr) ORDER BY ip DESC LIMIT 0,1";
        $stmt = $pdo->prepare($country_sql);
        $stmt->execute(['remote_addr' => $_SERVER['REMOTE_ADDR']]);
        $country_res = $stmt->fetch(PDO::FETCH_ASSOC);
        $country = $country_res['country'];
        return $country;
    }
    function insert_new_visit() {




        $liste_ip=array('2a01:cb18:a79:8','2a01:e0a:517:59','10.5.33.2','88.124.93.101','2a01:cb19:3f:6c','2a01:cb19:3f:6c00:24d8:ff8b:22b3:811b',
            '2a01:cb1a:4051:40fc:4cc6:db85:4777:9344','2a01:cb01:3020:f5e5:3f68:5a2a:622e:f23b','2a01:cb19:3f:6c00:25b3:d216:a156:1497','2a01:cb19:3f:6c00:5a1:aea1:45d1:909d','2a01:cb19:3f:6c00:a030:dcac:a474:ccfe');

        $liste_ip_str ="";

        foreach ($liste_ip as $ip) {
            $liste_ip_str .= "'" . $ip . "',";
        }

        $liste_ip_str = rtrim($liste_ip_str, ',');

        $pdo = new PDO('mysql:host=ojrh.myd.infomaniak.com;dbname=ojrh_willo', 'ojrh_RAD', '23564092R');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $insert_sql = "INSERT INTO {$this->table_name} (id, ip_adr, client, visit_date, time, on_page)
            SELECT NULL, :remote_addr, :client, CURDATE(), CURTIME(), :on_page
            FROM DUAL
            WHERE :remote_addr NOT IN ($liste_ip_str) and :client NOT LIKE '%SM-G930F%' and :client NOT LIKE '%SM-A202F%' and :client NOT LIKE'%curl/7.29.0%'";
        $stmt = $pdo->prepare($insert_sql);
        $stmt->execute([
            'remote_addr' => $_SERVER['REMOTE_ADDR'],
            'client' => $_SERVER['HTTP_USER_AGENT'],
            'on_page' => $_SERVER['PHP_SELF']
        ]);
    }

    function show_all_visits() {
        $ip_willo="2a01:cb18:a79:8";

        $pdo = new PDO('mysql:host=ojrh.myd.infomaniak.com;dbname=ojrh_willo', 'ojrh_RAD', '23564092R');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $pdo->query("SELECT COUNT(*) AS count FROM {$this->table_name} WHERE ip_adr != '.$ip_willo.' ");
        $visits = $result->fetch(PDO::FETCH_ASSOC)['count'];
        return $visits;
    }
    function show_visits_today() {
        $ip_willo="2a01:cb18:a79:8";

        $pdo = new PDO('mysql:host=ojrh.myd.infomaniak.com;dbname=ojrh_willo', 'ojrh_RAD', '23564092R');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $res_today = $pdo->query("SELECT COUNT(*) AS count FROM {$this->table_name} WHERE visit_date = CURDATE() WHERE ip_adr != '.$ip_willo.'");
        $today = $res_today->fetch(PDO::FETCH_ASSOC)['count'];
        return $today;
    }
    function first_last_visit($type = "last") {

        $pdo = new PDO('mysql:host=ojrh.myd.infomaniak.com;dbname=ojrh_willo', 'ojrh_RAD', '23564092R');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $order_dir = ($type == "last") ? "DESC" : "ASC";
        $result = $pdo->query("SELECT visit_date, time FROM {$this->table_name} ORDER BY visit_date {$order_dir} LIMIT 0,1");
        $first_last = $result->fetch(PDO::FETCH_ASSOC)['visit_date'];
        $first_last .= " " . $result->fetch(PDO::FETCH_ASSOC)['time'];
        return $first_last;
    }
    function results_by_day($res_month, $res_year) {

        $pdo = new PDO('mysql:host=ojrh.myd.infomaniak.com;dbname=ojrh_willo', 'ojrh_RAD', '23564092R');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT DAYOFMONTH(visit_date) AS visit_day, COUNT(*) AS visits_count FROM {$this->table_name} WHERE MONTH(visit_date) = :res_month AND YEAR(visit_date) = :res_year GROUP BY visit_date";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['res_month' => $res_month, 'res_year' => $res_year]);

        $visits_daily = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $visits_daily[$row['visit_day']] = $row['visits_count'];
        }
        return $visits_daily;
    }
    function results_by_month() {

        $pdo = new PDO('mysql:host=ojrh.myd.infomaniak.com;dbname=ojrh_willo', 'ojrh_RAD', '23564092R');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = sprintf("SELECT MONTH(visit_date) AS visits_month, COUNT(*) AS month_count FROM %s GROUP BY MONTH(visit_date) ORDER BY visit_date LIMIT 0,12", $this->table_name);
        $stmt = $pdo->prepare($sql);
        $visits_monthly = array();
        while ($obj = $stmt->fetchObject()) {
            $visits_monthly[$obj->visits_month] = $obj->month_count;
        }
        return $visits_monthly;
    }
    function res_country_top() {

        $pdo = new PDO('mysql:host=ojrh.myd.infomaniak.com;dbname=ojrh_willo', 'ojrh_RAD', '23564092R');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = sprintf("SELECT ip2nationcountries.country AS in_country, COUNT(*) AS visits_country FROM %s AS tbl LEFT JOIN ip2nationcountries ON ip2nationcountries.code = tbl.country WHERE tbl.country <> '' GROUP BY tbl.country ORDER BY 2 DESC LIMIT 0,10", $this->table_name);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $country_top = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $country_top[$row['in_country']] = $row['visits_country'];
        }
        return $country_top;
    }
    function get_days($from_month, $from_year) {
        $last_day = date("t", mktime(0,0,0,$from_month,1,$from_year));
        $day_count = 1;
        while ($day_count <= $last_day) {
            $days_array[] = $day_count;
            $day_count++;
        }
        return $days_array;
    }
    function create_date($month2, $year2) {
        $date_str = date ("M y", mktime (0,0,0,$month2,0,$year2));
        return $date_str;
    }
    function month_last_year() {
        $i = 0;
        while ($i < 12) {
            $twelve_month[$i] = date("n", mktime(0,0,0,date("n")-$i,15,date("Y")));
            $i++;
        }
        return $twelve_month;
    }
    function build_rows_totals($array_labels, $array_values) {
        $all_values = array_sum($array_values);
        $row = "";
        foreach($array_labels as $label) {
            if (isset($array_values[$label])) {
                $row .= "  <tr>\n";
                $row .= "	   <td>".$label."</td>\n";
                $width = ($array_values[$label]*100)/$all_values;
                $row .= "	   <td><img src=\"".IMG."\" width=\"".round($width*3, 0)."\" height=\"10\"></td>\n";
                $row .= "	   <td>".$array_values[$label]."</td>\n";
                $row .= "  </tr>\n";
            }
        }
        return $row;
    }
    function stats_country() {
        $country_visits = $this->res_country_top();
        $country_array = array_keys($country_visits);
        $country_tbl = "<h2>Visits by country (Top ".count($country_array).")</h2>\n";
        $country_tbl .= "<table width=\"480\" border=\"1\" cellspacing=\"2\" cellpadding=\"0\">\n";
        $country_tbl .= "  <tr>\n";
        $country_tbl .= "    <th>Month</th>\n";
        $country_tbl .= "    <th>&nbsp;</th>\n";
        $country_tbl .= "    <th>Visits</th>\n";
        $country_tbl .= "	 </tr>\n";
        $country_tbl .= $this->build_rows_totals($country_array, $country_visits);
        $country_tbl .= "</table>\n";
        return $country_tbl;
    }
    function stats_totals() {
        $month_array = $this->month_last_year();
        krsort($month_array);
        reset($month_array);
        $all_visits_month = $this->results_by_month();
        $total_tbl = "<h2>Visits last ".count($all_visits_month)." month</h2>\n";
        $total_tbl .= "<table width=\"480\" border=\"1\" cellspacing=\"2\" cellpadding=\"0\">\n";
        $total_tbl .= "  <tr>\n";
        $total_tbl .= "    <th>Month</th>\n";
        $total_tbl .= "    <th>&nbsp;</th>\n";
        $total_tbl .= "    <th>Visits</th>\n";
        $total_tbl .= "	 </tr>\n";
        $total_tbl .= $this->build_rows_totals($month_array, $all_visits_month);
        $total_tbl .= "</table>\n";
        return $total_tbl;
    }
    function stats_monthly($month, $year) {
        $my_visits = $this->results_by_day($month, $year);
        $total_visits = array_sum($my_visits);
        $month_tbl = "<h2>Visits in ".$this->create_date($month, $year)." (total: ".$total_visits.")</h2>\n";
        $month_tbl .= "<table width=\"760\" border=\"1\" cellspacing=\"2\" cellpadding=\"0\">\n";
        $month_tbl .= "  <tr>\n";
        foreach($this->get_days($month, $year) as $day) {
            if (isset($my_visits[$day])) {
                $month_tbl .= "	   <td>".$my_visits[$day]."</td>\n";
            } else {
                $month_tbl .= "    <td>n/a</td>\n";
            }
        }
        $month_tbl .= "	 </tr>\n";
        $month_tbl .= "  <tr>\n";
        foreach($this->get_days($month, $year) as $day) {
            if (isset($my_visits[$day])) {
                $height = ($my_visits[$day]*100)/$total_visits;
                $month_tbl .= "	   <td align=\"center\" valign=\"bottom\"><img src=\"".IMG."\" width=\"10\" height=\"".round($height*20, 0)."\"></td>\n";
            } else {
                $month_tbl .= "    <td>&nbsp;</td>\n";
            }
        }
        $month_tbl .= "	 </tr>\n";
        $month_tbl .= "  <tr>\n";
        foreach($this->get_days($month, $year) as $day) {
            $month_tbl .= "	   <td>".$day."</td>\n";
        }
        $month_tbl .= "  </tr>\n";
        $month_tbl .= "</table>\n";
        return $month_tbl;
    }
}
?>