<?php
/*
* Autor: Hss
* Data: 02/08/2020
* Versão: 1.0
*
*/
class ParseM3u {
    public function getArray($uri){
        $uri = file_get_contents($uri);
        preg_match_all('/(?P<tag>#EXTINF:-1)|(?:(?P<prop_key>[-a-z]+)=\"(?P<prop_val>[^"]+)")|(?<something>,[^\r\n]+)|(?<url>http[^\s]+)/', $uri, $match );
        
        $count = count( $match[0] );
        
        $result = [];
        $index = -1;
        
        for( $i =0; $i < $count; $i++ ){
            $item = $match[0][$i];
        
            if( !empty($match['tag'][$i])){
                //is a tag increment the result index
                ++$index;
            }elseif( !empty($match['prop_key'][$i])){
                //is a prop - split item
                $result[$index][$match['prop_key'][$i]] = $match['prop_val'][$i];
            }elseif( !empty($match['something'][$i])){
                //is a prop - split item
                $result[$index]['something'] = $item;
            }elseif( !empty($match['url'][$i])){
                $result[$index]['url'] = $item ;
            }
        }
        return $result;
    }
    public function getCategory($arr){
        $category = array_column($arr, 'group-title');
        return array_unique($category);
    }
}