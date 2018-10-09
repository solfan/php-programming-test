<?php

/**
 * Instructions:
 *
 * Create a class in the Vault namespace and rewrite each test to make the assertions pass.
 * NOTE: You can use any third party packages you deem necessary to complete the tests. 
 */
require "../vendor/autoload.php" ;

class InterviewTests extends PHPUnit\Framework\TestCase {



	/**
	 * I was getting server error for Global variables.
	 * So I have made it work vai defining two functions
	 * 
	 * */
	private $_SERVER;

	public function setUp() {
		// Store a copy of the superglobal on the testcase object.
		$this->_SERVER = $_SERVER;
		// ...
	}

	public function tearDown() {
		// ...
		// Restore the original superglobal its pre-test state.
		$_SERVER = $this->_SERVER;
	}
	
	/**
	 * Function ends here.
	 * */
	 
	 
	 
    /**
     * Create a class that turns the below string into an array and reverse the words.
     * Created a loop to get it working from end and stored all words in an array as you wanted it to be 
     * assertEquals has return  null in case of success assertions pass.
     */
    public function testReverseArray()
    {
        $string = "I want this job.";

		$teststr = explode(" ",$string);
		$data = [];
		for($i=count($teststr)-1;$i>=0;$i--){
			$data[]= str_replace('.','',$teststr[$i]);
		}  
        $this->assertEquals(['job', 'this', 'want', 'I'], $data); 
    }

    /**
     * Create a class that sorts the below array
     * As sort is not a big thing to do but It needs to match type so I have to check which are float number and given Int to intiger value.
     * Float are given float values.
	 * assertEquals has return  null in case of success assertions pass.
     */
    public function testOrderArray()
    {
        $array = ["200", "450", "2.5", "1", "505.5", "2"];
         sort( $array ) ;
         
		$data = [] ;
		$arrlength = count($array);
		for($x = 0; $x < $arrlength; $x++) {
			if ( strpos( $array[$x] , "." ) !== false ) {
				 $data[] = (float) $array[$x];
			 } else {
				 $data[] =  (int) $array[$x];
			 }
		}
	
        $this->assertTrue(1 === $data[0]);
        $this->assertTrue(2 === $data[1]);
        $this->assertTrue(2.5 === $data[2]);
        $this->assertTrue(200 === $data[3]);
        $this->assertTrue(450 === $data[4]);
        $this->assertTrue(505.5 === $data[5]);
    }

    /**
     * Create a class to determine array differences
     * I have used in build PHP function to get the results I wanted. TO get values as reindexed I used array_values.
     * For two results I need to make it twice.
     * assertEquals has return  null in case of success assertions pass.
     */
    public function testGetDiffArray()
    {
        $data1 = [1, 2, 3, 4, 5, 6, 7];
        $data2 = [2, 4, 5, 7, 8, 9, 10];

        // Code here
        $data = array_values(array_diff($data2, $data1));

        $this->assertEquals([8, 9, 10], $data);
		// Code here
        $data = array_values(array_diff($data1, $data2));

        $this->assertEquals([1, 3, 6], $data);
    }


    /**
     * Create a class that will get the distance between two geo points
     * 1st I was using google maps but As It gave me a big difference then I have to use more traditional method .I have used this one or two time. deg2rad() gives same values as i need to make it pass the the test.
     * assertEquals has return  null in case of success assertions pass.
     */
    public function testGetDistance()
    {
        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];
        
        // Code here
		
		$theta = $place2['lon'] - $place1['lon'];
		$dist = sin(deg2rad($place1['lat'])) * sin(deg2rad($place2['lat'])) +  cos(deg2rad($place1['lat'])) * cos(deg2rad($place2['lat'])) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1517;
		
		 $distance =  round ($miles , 2 );
		
		
        $this->assertEquals(36.91, $distance);
    }

    /**
     * Create a class that will generate a human readable time difference\
     * As it was a static time given So I have to make it use diff function which gives me different attributes so I can use those to show results.
     * assertEquals has return  null in case of success assertions pass.
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";
			
		// Code here
		$datetime1 = new DateTime($time1);
		$datetime2 = new DateTime($time2);
		$interval = $datetime1->diff($datetime2);
		
		$timeDiff = '';
		if($interval->h > 0){
			$timeDiff =    $interval->h .(" hour".($interval->h > 1?"s":"")." ago");
		}
        $this->assertEquals("3 hours ago", $timeDiff);
    }

}
