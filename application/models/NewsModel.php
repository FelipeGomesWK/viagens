<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsModel extends CI_Model
{
    public  $id;
    public  $title;
    public  $description;
    public  $date;
    //public  $imageUrl;
    
    public function getNewsOfService() {      
        $content = file_get_contents('http://prncloud.com/xml/rss_generico.php?clienteNews=277&amp;paisNews=8');
        return $this->formatNewsForDb($content);
    }
    
    public function getNewsOfDb() {  
        $this->db->order_by('date', 'DESC');
        $this->db->order_by('title', 'ASC');  
        return $this->db->get('news')->result();       
    }
    
    private function formatNewsForDb($content){
        $rss = new SimpleXmlElement($content);
        foreach($rss->channel as $feed) {
            $news[] = array(
                'title' => (string)$feed->title,
                'description' => (string)$feed->description,
                'date' => Date('Y-m-d'),
                'img' => "assets/img/image".rand(1,5).".jpg"
            );
        }
        
        return $news;
    }
    
    public function formatNewsForView($result){
        $news = array();
        $i = 0;
        foreach ($result as $feed) {
            $feed = (object) array_merge( (array)$feed, array( 'order' => $i ) );    
            $feed->date = date_format(date_create($feed->date),'d/m/Y');
            array_push($news,$feed);
            $i++;
        }
        return json_encode( $news, JSON_UNESCAPED_UNICODE);
    }
    
    public function saveNews($news) {
        foreach($news as $feed ){
            if (!$this->ExistsNewsInDB($feed)) {
                $this->db->insert('news', $feed);
            }
        }
    }
    
    private function ExistsNewsInDB($news){
        $query = $this->db->get_where('news', array('description' => $news['description']));
        return $query->num_rows();
        }
        
    public function sendNewsLetterForEmail($emails, $title, $content){
        
        $this->load->library('email'); 

            foreach ($emails as $email) {
                $this->email->from("test@test.com", 'PRNewswire');
                $this->email->subject($title);
                $this->email->reply_to("test@test.com");
                $this->email->to($email);
                $this->email->message($content);
                $this->email->send();
            }
            return "Emails enviados com sucesso";
        }    
}

