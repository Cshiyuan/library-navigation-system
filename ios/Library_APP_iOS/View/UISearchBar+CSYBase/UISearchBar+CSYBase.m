//
//  UISearchBar+CSYBase.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/9.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "UISearchBar+CSYBase.h"

@implementation UISearchBar (CSYBase)

-(void)removeBorderWithBackgroundColor:(UIColor*)color
{
    //遍历出UISearchBar的背景，从父窗口remove掉
    for (UIView *subview in [[self.subviews firstObject] subviews]) {
        if ([subview isKindOfClass:NSClassFromString(@"UISearchBarBackground")]) {
            [subview removeFromSuperview];
        }
    }
    
    //重新设置颜色
    [self setBackgroundColor:color];
}

@end
