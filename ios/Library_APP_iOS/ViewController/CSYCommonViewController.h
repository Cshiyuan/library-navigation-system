//
//  CSYCommonViewController.h
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/5.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface CSYCommonViewController : UIViewController


-(void)startLoadingWithIndicator;
-(void)stopLoadingWithIndicator;

- (void)presentViewController:(UIViewController*)vc;
- (void)presentLoginViewController;
-(void)presentAlertControllerWithMessage:(NSString *)msg preferredStyle:(UIAlertControllerStyle)style;

@end
