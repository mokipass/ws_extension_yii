# Mokipass Web Service extension class for Yii framework
MOKIPASS is the solution that suggests changing all your loyalty cards with only one card. It allows keeping only one loyalty card in the wallet instead of all. This service is available only in points of sale, which participate in the programme. 
MOKIPASS  is the cards‘ wallet in your Smartphone. Keep all your loyalty cards in your Smartphone. Now you can keep all your loyalty cards in MOKIPASS. Anytime you can view merchant’s offers and the history of your purchases and share the cards’ advantages with your family.


#Features
Currently Mokipass supports the following:
  -Generate SSO ID
  -Check loyalty cards
  -Add new loyalty card
  -Activete loyalty card


#Usage
//application components in protected/config
  

    'components'=>array (
      'Mokipass'=>array (
        'class'=>'application.extensions.Mokipass.Mokipass',
        'POS_ID'=>null,
        'username'=>'user_name',
        'password'=>'password',
      ), 
    ), 


