//
//  CSYLoginView.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/2.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "CSYLoginView.h"
#import "Masonry.h"
#import "UIView+CSYBase.h"

@interface CSYLoginView() <UITextFieldDelegate>
{
    LoginAction _loginAction;
}

@end


@implementation CSYLoginView

//重写initWithCoder:用代码添加子控件
-(id)initWithCoder:(NSCoder *)aDecoder
{
    self = [super initWithCoder:aDecoder];
    if(self)
    {
        [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(textFieldChanged:) name:UITextFieldTextDidChangeNotification object:_passWord];
        [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(textFieldChanged:) name:UITextFieldTextDidChangeNotification object:_userName];
        self.userInteractionEnabled = YES;
    }
    return self;
}


-(void)awakeFromNib
{
    [super awakeFromNib];
    [_loginButton addTarget:self action:@selector(loginAction:) forControlEvents:UIControlEventTouchUpInside];
    _loginButton.userInteractionEnabled = NO;
    _loginButton.alpha = 0.5;
    _loginButton.layer.cornerRadius = 10;
    _passWord.secureTextEntry = YES;
    _passWord.delegate = self;
    _userName.delegate = self;
}

#pragma -mark UITextFieldDelegate
- (BOOL)textFieldShouldEndEditing:(UITextField *)textField
{
    return YES;
}

- (BOOL)textFieldShouldReturn:(UITextField *)textField
{
    if(textField == _passWord)
    {
        [self loginAction:_loginButton];
    } else {
        [_passWord becomeFirstResponder];
    }
    return YES;
}

-(void)loginAction:(UIButton *)button
{
    if(_loginAction)
    {
        _loginAction(_userName.text,_passWord.text);
    }
}

-(void)setLoginAction:(LoginAction)action
{
    if(action)
    {
        _loginAction = action;
    }
}

#pragma -mark NSNotification
-(void)textFieldChanged:(UITextField*)textField
{
    if(![_passWord.text isEqualToString:@""] && ![_userName.text isEqualToString:@""])
    {
        _loginButton.userInteractionEnabled = YES;
        _loginButton.alpha = 1.0;
    }
}





@end
