//
//  UIView+CSYBase.h
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/2.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface UIView (CSYBase)

+(instancetype)getView;
-(void)setGradientColorWith:(UIColor*) startColor toColor:(UIColor*) endColor WithAlpha:(double)alpha;

-(void)setKeyboardNotifiation;
@end
