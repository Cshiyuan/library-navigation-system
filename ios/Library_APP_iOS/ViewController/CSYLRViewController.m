//
//  LoginViewController.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/2.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "CSYLRViewController.h"
#import "CSYLoginView.h"
#import "Masonry.h"
#import "CSYHTTPClient.h"
#import "CSYRegisterView.h"

#define SCREEN_WIDTH ([[UIScreen mainScreen] bounds].size.width)
#define SCREEN_HEIGHT ([[UIScreen mainScreen] bounds].size.height)

@interface CSYLRViewController ()
{
    UIButton *_registerButton;
    UIButton *_loginButton;
    CSYLoginView *_loginView;
    CSYRegisterView *_registerView;
    double _moveHeight;
    UIImage *_backgroundImage;
}


-(void)p_setBackGroundImageAndEffect;
-(void)p_setLoginView;
-(void)p_setRegisterView;
@end

@implementation CSYLRViewController

- (void)viewDidLoad
{
    [super viewDidLoad];
    _moveHeight = 0;
    [[NSNotificationCenter defaultCenter]addObserver:self selector:@selector(didClickKeyboard:) name:UIKeyboardDidChangeFrameNotification object:nil];
    [[NSNotificationCenter defaultCenter]addObserver:self selector:@selector(didKeyboardDisappear:) name:UIKeyboardWillHideNotification object:nil];
    //设置背景和效果
    [self p_setBackGroundImageAndEffect];
    [self p_setLoginView];
    [self p_setRegisterView];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

-(void)setBackgroundImage:(UIImage *)image
{
    _backgroundImage = image;
}

#pragma -mark 设置背景
-(void)p_setBackGroundImageAndEffect
{
    UIImage *background;
    if(!_backgroundImage) {
        background = _backgroundImage;
    } else {
        background = [UIImage imageNamed:@"background"];
    }
    UIImageView* backgroundImageView = [[UIImageView alloc]initWithImage:background];
    backgroundImageView.frame = self.view.frame;
    UIBlurEffect* blurEffect = [UIBlurEffect effectWithStyle:UIBlurEffectStyleDark];
    UIVisualEffectView *visualEffectView = [[UIVisualEffectView alloc]initWithEffect:blurEffect];
    visualEffectView.frame = backgroundImageView.frame;
    visualEffectView.alpha = 0.9;
    [backgroundImageView addSubview:visualEffectView];
    [self.view addSubview:backgroundImageView];
}
#pragma -mark 设置登录View
-(void)p_setLoginView
{
    _loginView = [CSYLoginView getView];
    _loginView.layer.cornerRadius = 10;
    _loginView.alpha = 0.8;
    _loginView.frame = CGRectMake(SCREEN_WIDTH * 0.1, SCREEN_HEIGHT/2 - SCREEN_WIDTH * 0.4, SCREEN_WIDTH * 0.8, SCREEN_WIDTH * 0.8);
    
    [self.view addSubview:_loginView];
    
    
    _registerButton = [[UIButton alloc]init];
    _registerButton.layer.cornerRadius = 20;
    _registerButton.alpha = 0.8;
    [_registerButton setTitle:@"注册" forState:UIControlStateNormal];
    [_registerButton setTitleColor:[UIColor blackColor] forState:UIControlStateNormal];
    [_registerButton setBackgroundColor:[UIColor whiteColor]];
    [_registerButton addTarget:self action:@selector(showRegisterView) forControlEvents:UIControlEventTouchUpInside];
    [self.view addSubview:_registerButton];
    [self showRegisterButton];
    
    __weak typeof(self) weakSelf = self;
    [_loginView setLoginAction:^(NSString *email, NSString *password) {
        [weakSelf startLoadingWithIndicator];
            [[CSYHTTPClient defaultClient]getPath:LOGIN_URL parameters:@{@"email": email,@"password":password} success:^(NSURLSessionDataTask *task, id responseObject) {
                if (![responseObject isKindOfClass:[NSDictionary class]]) {

                }
                NSDictionary *responseDic = responseObject;
                NSNumber *code = responseDic[@"data"][@"code"];
                if ([code isEqualToNumber:@200])
                {
                    [weakSelf presentAlertControllerWithMessage:@"登陆成功" preferredStyle:UIAlertControllerStyleActionSheet];
                    [weakSelf dismissViewControllerAnimated:YES completion:nil];
                    NSUserDefaults *userDefaults = [NSUserDefaults standardUserDefaults];
                    [userDefaults setBool:YES forKey:@"isLogin"];
                }
                else
                {
                    NSString *msg = responseDic[@"data"][@"msg"];
                    [weakSelf presentAlertControllerWithMessage:msg preferredStyle:UIAlertControllerStyleAlert];
                }
                NSLog(@"%@",code);
                
            } failure:^(NSURLSessionDataTask *task, NSError *error) {
                [weakSelf presentAlertControllerWithMessage:@"网络错误" preferredStyle:UIAlertControllerStyleAlert];
            }];
        
        [weakSelf stopLoadingWithIndicator];
    }];
}
#pragma -mark  设置注册View
-(void)p_setRegisterView
{
    _registerView = [CSYRegisterView getView];
    _registerView.layer.cornerRadius = 10;
    _registerView.alpha = 0.8;
    _registerView.staticTopicTitleLabel.text = @"";
    
    _registerView.frame = CGRectMake(SCREEN_WIDTH * 0.1, SCREEN_HEIGHT/2 - SCREEN_WIDTH * 0.4, 0, SCREEN_WIDTH * 0.8 + 20);
    
    [self.view addSubview:_registerView];
    
    _loginButton = [[UIButton alloc]init];
    _loginButton.layer.cornerRadius = 20;
    _loginButton.alpha = 0.8;
    [_loginButton setTitle:@"登陆" forState:UIControlStateNormal];
    [_loginButton setTitleColor:[UIColor blackColor] forState:UIControlStateNormal];
    [_loginButton setBackgroundColor:[UIColor whiteColor]];
    [_loginButton addTarget:self action:@selector(hideRegisterView) forControlEvents:UIControlEventTouchUpInside];
    [self.view addSubview:_loginButton];
    [self showRegisterButton];
    
    __weak typeof(self) weakSelf = self;
    
    [_registerView setRegisterAction:^(NSString *email, NSString *password, NSString *repassword,NSString* username) {
        
        if(![password isEqualToString:repassword])
        {
            [weakSelf presentAlertControllerWithMessage:@"两次输入密码不相同" preferredStyle:UIAlertControllerStyleAlert];
            return ;
        }
        
        [weakSelf startLoadingWithIndicator];
        [[CSYHTTPClient defaultClient]getPath:REGISTER_URL parameters:@{@"email": email,@"password":password,@"username":username} success:^(NSURLSessionDataTask *task, id responseObject) {
            if (![responseObject isKindOfClass:[NSDictionary class]]) {
                
            }
            NSDictionary *responseDic = responseObject;
            NSNumber *code = responseDic[@"data"][@"code"];
            if ([code isEqualToNumber:@200])
            {
                [weakSelf presentAlertControllerWithMessage:@"注册成功" preferredStyle:UIAlertControllerStyleAlert];
            }
            else
            {
                NSString *msg = responseDic[@"data"][@"msg"];
                [weakSelf presentAlertControllerWithMessage:msg preferredStyle:UIAlertControllerStyleAlert];
            }
            NSLog(@"%@",code);
        } failure:^(NSURLSessionDataTask *task, NSError *error) {
            [weakSelf presentAlertControllerWithMessage:@"网络错误" preferredStyle:UIAlertControllerStyleAlert];
        }];
        [weakSelf stopLoadingWithIndicator];
    }];

}
-(void)showRegisterView
{
    _registerView.staticTopicTitleLabel.text = @"注册";
    _loginView.staticTopicLabel.text = @"";
    [UIView animateWithDuration:1 animations:^{
        
        _registerView.frame = CGRectMake(_loginView.frame.origin.x, _loginView.frame.origin.y, SCREEN_WIDTH * 0.8, SCREEN_WIDTH * 0.8 + 20);
        
        CGRect rect = _loginView.frame;
        rect.size.width = 0;
        _loginView.frame = rect;
        [self hideRegisterButton];
        
    }];
}

-(void)hideRegisterView
{
    _registerView.staticTopicTitleLabel.text = @"";
    _loginView.staticTopicLabel.text = @"登陆";
    [UIView animateWithDuration:1 animations:^{
        
        _registerView.frame = CGRectMake(_loginView.frame.origin.x, _loginView.frame.origin.y, 0, SCREEN_WIDTH * 0.8 + 20);
        
        CGRect rect = _loginView.frame;
        rect.size.width = SCREEN_WIDTH * 0.8;
        _loginView.frame = rect;
        [self showRegisterButton];
        
    }];

}


#pragma mark -键盘即将跳出
-(void)didClickKeyboard:(NSNotification *)sender
{
    NSLog(@"didClickKeyboard");
    CGFloat durition = [sender.userInfo[@"UIKeyboardAnimationDurationUserInfoKey"] doubleValue];
    CGRect keyboardRect = [sender.userInfo[@"UIKeyboardFrameEndUserInfoKey"] CGRectValue];
    double betweenHeight = (SCREEN_HEIGHT/2 - SCREEN_WIDTH * 0.4 + SCREEN_WIDTH * 0.8) - keyboardRect.origin.y;
    if (betweenHeight > 0) {
        _moveHeight = betweenHeight;
    }

    if(betweenHeight > 0)
    {
        [UIView animateWithDuration:durition animations:^{
        
            _registerView.transform = CGAffineTransformMakeTranslation(0, -_moveHeight-20);
            _loginView.transform = CGAffineTransformMakeTranslation(0, -_moveHeight-20);
            _registerButton.transform = CGAffineTransformMakeTranslation(0, -_moveHeight-20);
            _loginButton.transform = CGAffineTransformMakeTranslation(0, -_moveHeight-20);
        
        }];
    }

}

#pragma mark -当键盘即将消失

-(void)didKeyboardDisappear:(NSNotification *)sender
{
    NSLog(@"didKeyboardDisappear");
    CGFloat duration = [sender.userInfo[@"UIKeyboardAnimationDurationUserInfoKey"] doubleValue];
    [UIView animateWithDuration:duration animations:^{
        _loginView.transform = CGAffineTransformIdentity;
        _registerView.transform = CGAffineTransformIdentity;
        _registerButton.transform = CGAffineTransformIdentity;
        _loginButton.transform = CGAffineTransformIdentity;
        
    }];
    _moveHeight = 0;
    
}

// 触摸背景，关闭键盘
- (void)touchesBegan:(NSSet *)touches withEvent:(UIEvent *)event{
    UITouch *touch = [touches anyObject];
    UIView *view = (UIView *)[touch view];
    if (view == self.view || view == _loginView || view == _registerView) {
        [_loginView endEditing:YES];
        [_registerView endEditing:YES];
    }
}

-(void)hideRegisterButton
{
    _registerButton.frame = CGRectMake(CGRectGetMaxX(_loginView.frame)-30, CGRectGetMinY(_loginView.frame)-30, 0, 60);
    
    _loginButton.frame = CGRectMake(CGRectGetMaxX(_registerView.frame)-30, CGRectGetMinY(_registerView.frame)-30, 60, 60);
}

-(void)showRegisterButton
{
    _registerButton.frame = CGRectMake(CGRectGetMaxX(_loginView.frame)-30, CGRectGetMinY(_loginView.frame)-30, 60, 60);
    
    _loginButton.frame = CGRectMake(CGRectGetMaxX(_registerView.frame)-30, CGRectGetMinY(_registerView.frame)-30, 0, 60);
}

#pragma -mark 定制statusBar部分
-(UIStatusBarStyle)preferredStatusBarStyle
{
    return UIStatusBarStyleLightContent;
}
@end
