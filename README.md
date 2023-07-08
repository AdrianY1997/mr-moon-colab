
[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Visual Studio Code](https://img.shields.io/badge/VSC-0078d7.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white)](https://code.visualstudio.com/)
[![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)](https://github.com/AdrianY1997)

[<div style="width: 100%; text-align: center"><img src="./Resources/img/favicon.png" height="200" style="" /></div>]()


## Under Construction

this README is keep under construction

## Notes

1. In this version a small change is made in the folder structure for better code reading
2. The interaction with the database through the models now has a direct relationship with its properties
    
    To insert you need to create an instance of the model, add the data described in `$fillable` and send it to the object.
    
    ```php
    $user = new User();
    $user->user_nick = "DarkMorita";
    User::insert($user); 
    User::insert([$user]);
    ```

## License

This project is licensed under the terms of the [MIT](http://opensource.org/licenses/mit-license.php) license.