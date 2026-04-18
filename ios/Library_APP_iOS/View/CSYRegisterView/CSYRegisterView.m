//
//  CSYRegisterView.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/12.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "CSYRegisterView.h"
#import "UIView+CSYBase.h"


@interface CSYRegisterView() <UITextFieldDelegate>
{
    RegisterAction _registerAction;
}

@end

@implementation CSYRegisterView

-(id)initWithCoder:(NSCoder *)aDecoder
{
    self = [super initWithCoder:aDecoder];
    if(self)
    {
        [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(textFieldChanged:) name:UITextFieldTextDidChangeNotification object:_passwordTextField];
        [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(textFieldChanged:) name:UITextFieldTextDidChangeNotification object:_repeatPasswordTextField];
        [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(textFieldChanged:) name:UITextFieldTextDidChangeNotification object:_emailTextField];
        self.userInteractionEnabled = YES;
    }
    return self;
}

#pragma -mark UITextFieldDelegate
- (BOOL)textFieldShouldEndEditing:(UITextField *)textField
{
    return YES;
}

- (BOOL)textFieldShouldReturn:(UITextField *)textField
{
    if(textField == _repeatPasswordTextField) {
        [self registerAction:_registerButton];
    } else if (textField == _emailTextField) {
        [_passwordTextField becomeFirstResponder];
    } else if (textField == _passwordTextField) {
        [_repeatPasswordTextField becomeFirstResponder];
    } else if(textField == _usernameTextField) {
        [_emailTextField becomeFirstResponder];
    }
    return YES;
}

-(void)awakeFromNib
{
    [super awakeFromNib];
    [_registerButton addTarget:self action:@selector(registerAction:) forControlEvents:UIControlEventTouchUpInside];
    _registerButton.userInteractionEnabled = NO;
    _registerButton.alpha = 0.5;
    _registerButton.layer.cornerRadius = 10;
    _passwordTextField.secureTextEntry = YES;
    _repeatPasswordTextField.secureTextEntry = YES;
    
    _usernameTextField.delegate = self;
    _emailTextField.delegate = self;
    _repeatPasswordTextField.delegate = self;
    _passwordTextField.delegate = self;
}

-(void)registerAction:(UIButton *)button
{
    if(_registerAction)
    {
        _registerAction(_emailTextField.text,_passwordTextField.text,_repeatPasswordTextField.text,_usernameTextField.text);
    }
}

-(void)setRegisterAction:(RegisterAction)action
{
    if(action)
    {
        _registerAction = action;
    }
}

#pragma -mark NSNotification
-(void)textFieldChanged:(UITextField*)textField
{
    if(![_passwordTextField.text isEqualToString:@""] && ![_emailTextField.text isEqualToString:@""] && ![_repeatPasswordTextField.text isEqualToString:@""] &&! [_usernameTextField.text isEqualToString:@""])
    {
        _registerButton.userInteractionEnabled = YES;
        _registerButton.alpha = 1.0;
    }
}

@end
