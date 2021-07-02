
    Tematy zadania
    
    - From attached XML file, please export data to Redis,                                                           ZROBIŁEM
      
	
    - key "subdomains" will contain JSON with all subdomains                                                         ZROBIŁEM
      (e.g. ["http://secureline.tools.avast.com", "http://gf.tools.avast.com"]),


    - keys "cookie:%NAME%:%HOST%" will contain values of cookie elements                                             ZROBIŁEM
      (e.g. key "cookie:dlp-avast:amazon" will contain string "mmm_amz_dlp_777_ppc_m"),

								
    - use docker-compose for setting up cloud environment
      (PHP and Redis needs to have their own containers),


    - please use PHPUnit for tests.


    - to run the app please use this command:                                          export.sh /path/to/xml        ZROBIŁEM


    - if "-v" argument is present in command it should print all keys saved to Redis   export.sh -v /path/to/xml     ZROBIŁEM
