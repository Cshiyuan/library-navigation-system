//
//  UIView+CSYBase.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/2.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "UIView+CSYBase.h"

@implementation UIView (CSYBase)

/*
// Only override drawRect: if you perform custom drawing.
// An empty implementation adversely affects performance during animation.
- (void)drawRect:(CGRect)rect {
    // Drawing code
}
*/

-(void)setKeyboardNotifiation
{
    //注册键盘出现的通知
    [[NSNotificationCenter defaultCenter] addObserver:self
                                                 selector:@selector(keyboardWillChange:)
                                                     name:UIKeyboardDidChangeFrameNotification object:nil];
    //注册键盘消失的通知
    [[NSNotificationCenter defaultCenter] addObserver:self
                                                 selector:@selector(keyboardWillHide:)
                                                     name:UIKeyboardWillHideNotification object:nil];
    
    UITapGestureRecognizer *singleTap = [[UITapGestureRecognizer alloc] initWithTarget:self action:@selector(fingerTapped:)];
    [self addGestureRecognizer:singleTap];
}

///键盘显示事件
- (void) keyboardWillChange:(NSNotification *)notification {
    CGFloat duration = [notification.userInfo[@"UIKeyboardAnimationDurationUserInfoKey"] doubleValue];
    CGRect keyboardRect = [notification.userInfo[@"UIKeyboardFrameEndUserInfoKey"] CGRectValue];
    CGFloat keyboardHeight = keyboardRect.origin.y;
    double bHeight = CGRectGetMaxY(self.frame) - keyboardHeight;
    if(bHeight > 0)
    {
        [UIView animateWithDuration:duration animations:^{
            self.transform = CGAffineTransformMakeTranslation(0, -bHeight-10);
        }];
    }
}

//键盘消失事件
- (void) keyboardWillHide:(NSNotification *)notify
{
    self.transform = CGAffineTransformIdentity;
}


-(void)fingerTapped:(UITapGestureRecognizer *)gestureRecognizer
{
    
    [self endEditing:YES];
}


+(instancetype)getView
{
    NSBundle *bundle = [NSBundle mainBundle];
    NSString *className = NSStringFromClass([self class]);
    NSArray *objs = [bundle loadNibNamed:className owner:nil options:nil];
    return [objs lastObject];
}

-(void)setGradientColorWith:(UIColor*) startColor toColor:(UIColor*) endColor WithAlpha:(double)alpha
{
    UIView *gradientView = [[UIView alloc]init];
    gradientView.frame = self.frame;
    gradientView.layer.cornerRadius = self.layer.cornerRadius;
    
    CAGradientLayer *gradientLayer = [CAGradientLayer layer];
    gradientLayer.frame = gradientView.bounds;
    [gradientView.layer addSublayer:gradientLayer];
    
    //设置渐变区域的起始和终止位置
    gradientLayer.startPoint = CGPointMake(0, 0);
    gradientLayer.endPoint = CGPointMake(0, 1);
    
    //设置颜色数组
    gradientLayer.colors = @[(__bridge id)startColor.CGColor,(__bridge id)endColor.CGColor];
    gradientView.alpha = alpha;
    
    [self.superview insertSubview:gradientView belowSubview:self];

}

@end
