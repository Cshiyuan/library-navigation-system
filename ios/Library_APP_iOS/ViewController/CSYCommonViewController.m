//
//  CSYCommonViewController.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/5.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "CSYCommonViewController.h"
#import "CSYToolSet.h"
#import "MBProgressHUD.h"
#import "CSYLRViewController.h"
#import "CSYNavigationController.h"

#define LOG_DATA(d) NSLog(@"%@", [[NSString alloc] initWithData:(d) encoding:NSUTF8StringEncoding])
#define INDICATOR_ALPHA 0.7f

#define HUDSuccessMessage(msg,d) ([SVProgressHUD showSuccessWithStatus:(msg) duration:(d)])
#define HUDErrorMessage(msg,d) ([SVProgressHUD showErrorWithStatus:(msg) duration:(d)])


float CSYHudShortDuration = 0.5f;
float CSYHudNormalDuration = 1.0f;
float CSYHudLongDuration = 2.0f;

//static const void *kDMLoadingHUDKey = "kDMLoadingHUDKey";



static NSOperationQueue *sRequestQueue = nil;


@interface CSYCommonViewController ()
{
    UIActivityIndicatorView *_indicator;
}

@end

@implementation CSYCommonViewController

- (void)viewDidLoad {
    [super viewDidLoad];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
}

#pragma mark -loading METHODS
-(void)startLoadingWithIndicator {
    
    if(!_indicator)
    {
        _indicator = [[UIActivityIndicatorView alloc]initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleWhiteLarge];
        //设置显示位置
        _indicator.center = self.view.center;
        _indicator.color = [UIColor grayColor];
        //将这个控件加到父容器中。
         [self.view addSubview:_indicator];
    }
    [_indicator startAnimating];
}

-(void)stopLoadingWithIndicator {
    
    if (!_indicator) {
        return;
    }
    [_indicator stopAnimating];
}


-(void)presentLoginViewController{
    
    [self.view endEditing:YES];

    
    CSYLRViewController *controller = [[CSYLRViewController alloc] init];
    
    UIImage *image = [CSYToolSet viewSnapshot:self.view withInRect:self.view.frame];
    [controller setBackgroundImage:image];
    
    CSYNavigationController *nav = [[CSYNavigationController alloc] initWithRootViewController:controller];
    [nav setNavigationBarHidden:YES animated:NO];
    
    if (self.navigationController) {
        
        [self.navigationController presentViewController:nav animated:YES completion:nil];
    } else {
        
        [self presentViewController:nav animated:YES completion:nil];
    }

}

-(void)presentViewController:(UIViewController*)vc
{
    CSYNavigationController *nav = [[CSYNavigationController alloc] initWithRootViewController:vc];
    [nav setNavigationBarHidden:YES animated:NO];
    
    if (self.navigationController) {
        
        [self.navigationController presentViewController:nav animated:YES completion:nil];
        
    } else {
        
        [self presentViewController:nav animated:YES completion:nil];
    }
}

-(void)presentAlertControllerWithMessage:(NSString *)msg preferredStyle:(UIAlertControllerStyle)style
{
    UIAlertController* alertController = [UIAlertController alertControllerWithTitle:@"提示" message:msg preferredStyle:style];
    [self presentViewController:alertController animated:YES completion:nil];
//    + (instancetype)alertControllerWithTitle:(NSString *)title message:(NSString *)message preferredStyle:(UIAlertControllerStyle)preferredStyle;
    [NSTimer scheduledTimerWithTimeInterval:1 target:self selector:@selector(creatAlert:) userInfo:alertController repeats:NO];
}

- (void)creatAlert:(NSTimer *)timer{
    
    UIAlertController *alert = [timer userInfo];
    [alert dismissViewControllerAnimated:YES completion:nil];
    alert = nil;
    
}

@end
