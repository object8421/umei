1. Securecrt
      * recover home_main.html
          *  ```
            cp -f umei_bak/view/public/room_main.html umei/view/public/room_main.html 
            ```
2. YUI Doc
      * inside of docs directory run 
        *   ```
            yuidocsite
            yuidocsite --port 3000 
            ```
        * go to site url in browser
            * http://localhost:3000 
3. Auth
      * 登录名 zhangsir     ID 32087834
        密码：1qa2ws
        anchor for actual environment
        medusa
        Qqq111
      * svn
        * http://svn.uumie.cn:666/web_client
        * zhanghl
        * china.com
      * server connection
        * http://svn.uumie.cn:666/web_client
        * zhanghl
        * zhl^&*
      * svn sync, connect to 114.215.127.210
      
        ```        
        cd /data/www/umweb
        svn up
        ```
4. Todo requirejs 
      * referring: http://www.rshining.net/archives/941    
          
5. Build
      * generate built front-end code
      ```
      grunt build:test
      ```
      * other: generate 'yuidoc', 'readme', 'plato'
      ```
      grunt or grunt default
      ```
      * todo 
        * handling the existed code
        ```
        grunt build:formal
        ```
        * generate a complete code dir
        ```
        grunt build:uumie
        ```