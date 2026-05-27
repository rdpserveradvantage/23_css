<?php
// $credentials = "admin:admin123"; 
         
         // Read the XML to send to the Web Service 
         $request_file = "./command.xml"; 
        $fh = fopen($request_file, 'r'); 
        $xml_data = fread($fh, filesize($request_file)); 
        fclose($fh); 
                echo "done";
        $url = "http://admin:admin123@10.60.242.76:81/ISAPI/ContentMgmt/InputProxy/channels/status"; 
        $page = "http://admin:admin123@10.60.242.76:81/ISAPI/ContentMgmt/InputProxy/channels/status"; 
        $headers = array( 
            "POST ".$page." HTTP/1.0", 
            "Content-type: text/xml;charset=\"utf-8\"", 
            "Accept: text/xml", 
            "Cache-Control: no-cache", 
            "Pragma: no-cache", 
            "SOAPAction: \"run\"", 
            "Content-length: ".strlen($xml_data), 
         //   "Authorization: Basic " . base64_encode($credentials) 
        ); 
       echo "curl init";
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
   //     curl_setopt($ch, CURLOPT_USERAGENT, $defined_vars['HTTP_USER_AGENT']); 
        echo "call";
        // Apply the XML to our curl call 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data); 
        echo "execute";
        $data = curl_exec($ch); 
         echo "result";
        if (curl_errno($ch)) { 
            print "Error: " . curl_error($ch); 
        } else { 
            // Show me the result 
            var_dump($data); 
            curl_close($ch); 
        } 

?>