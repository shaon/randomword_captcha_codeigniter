<?php

/**
 * 
 * Codeigniter random word generator for captcha
 * 
 * @author      Md. Imran Hossain Shaon
 * @version     1.0
 * @copyright   2011 Md. Imran Hossain Shaon
 * @license	GNU GPL
 * 
 * 	This program is free software; you can redistribute it and/or modify
 * 	it under the terms of the GNU General Public License as published by
 * 	the Free Software Foundation; either version 2 of the License, or
 * 	(at your option) any later version.
 *
 * 	This program is distributed in the hope that it will be useful,
 * 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * 	GNU General Public License for more details.
 */

// Inspired by class rand_word by Eric Sizemore

/*
 * Instructions:
 * 
 * Load the plugin using:
 * 
 *      $this->load->plugin('randomword');
 * 
 * and then call generate_word() with the following parameter
 * 
 *      $number_of_words: how many words you want to show
 * 
 *      $length: length of each word
 * 
 *      $type:
 *          'lc': all low letters
 *          'uc': all upper case letters
 *          'ucf': upper case letter in the beginning of each word
 * 
 *      example: generate_word(2, 4, 'ucf')
 * 
 * 
 */


if (!function_exists('generate_word')) {

    function generate_word($number_of_words = 1, $length = 5, $type = 'lc') {

        $random_words = '';

        while ($number_of_words) {

            $vowels = array('a', 'e', 'i', 'o', 'u', 'y');

            $consonants = array(
                'b', 'c', 'd', 'f', 'g', 'h',
                'j', 'k', 'l', 'm', 'n', 'p',
                'r', 's', 't', 'v', 'w', 'z',
                'ch', 'qu', 'th', 'xy', 'kl',
                'lt', 'sk', 'st', 'rt'
            );

            $word = '';

            $done = false;

            $const_or_vowel = 1;

            while (!$done) {
                switch ($const_or_vowel) {
                    case 1:
                        $word .= $consonants[array_rand($consonants)];
                        $const_or_vowel = 2;
                        break;
                    case 2:
                        $word .= $vowels[array_rand($vowels)];
                        $const_or_vowel = 1;
                        break;
                }

                if (strlen($word) >= $length) {
                    $done = true;
                }
            }

            $word = substr($word, 0, $length);

            switch ($type) {
                case 'lc':
                    $word = strtolower($word);
                    break;
                case 'uc':
                    $word = strtoupper($word);
                    break;
                case 'ucf':
                    $word = ucfirst(strtolower($word));
                    break;
                default:
                    $word = strtoupper($word);
                    break;
            }

            $random_words .= ' ' . $word;

            $number_of_words--;
        }

        return $random_words;
    }

}
