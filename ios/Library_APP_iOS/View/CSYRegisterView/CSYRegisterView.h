//
//  CSYRegisterView.h
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/12.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import <UIKit/UIKit.h>

typedef void(^RegisterAction)(NSString* email,NSString* password,NSString* repeatpassword,NSString* username);

@interface CSYRegisterView : UIView

@property (weak, nonatomic) IBOutlet UITextField *emailTextField;
@property (weak, nonatomic) IBOutlet UITextField *passwordTextField;
@property (weak, nonatomic) IBOutlet UITextField *repeatPasswordTextField;
@property (weak, nonatomic) IBOutlet UIButton *registerButton;
@property (weak, nonatomic) IBOutlet UITextField *usernameTextField;


@property (weak, nonatomic) IBOutlet UILabel *staticEmailLabel;
@property (weak, nonatomic) IBOutlet UILabel *staticPassWordLabel;
@property (weak, nonatomic) IBOutlet UILabel *staticRePassWordLabel;
@property (weak, nonatomic) IBOutlet UILabel *staticTopicTitleLabel;



-(void)setRegisterAction:(RegisterAction)action;

@end
