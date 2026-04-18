//
//  FMKInterpolator.h
//  FMMapKit
//
//  Created by FengMap on 15/11/4.
//  Copyright © 2015年 FengMap. All rights reserved.
//

#import <Foundation/Foundation.h>

typedef double GoingTime;
typedef double OriginalValue;
typedef double ChangedValue;


///插值函数类型
typedef NS_ENUM(NSInteger, FMKStageType)
{
    FMKSTAGE_IN = 0,
    FMKSTAGE_OUT,
    FMKSTAGE_INOUT
    
};

@interface FMKInterpolator : NSObject

/**
 *  缓动函数插值类型
 */
@property(nonatomic,assign) FMKStageType type;

/**
 *  插值器初始化
 *
 *  @param STAGE_TYPE 插值类型 默认使用USE_INOUT
 *
 *  @return 插值器对象
 */
- (instancetype)initWithStageType:(FMKStageType)stageType;


/**
 *  插值器类型函数 FMKSTAGE_IN
 *
 *  @param goingTime    已运行时间
 *  @param start        起始值
 *  @param changed      改变量
 *  @param durationTime 持续时间
 *
 *  @return 计算插值
 */
- (double)inWithGoingTime:(GoingTime)goingTime
                 withStart:(OriginalValue )start
                  withEnd:(ChangedValue )changed
         withDuration:(NSTimeInterval)duration;
/**
 *  插值器类型函数 FMKSTAGE_OUT
 *
 *  @param goingTime    已运行时间
 *  @param start        起始值
 *  @param changed      改变量
 *  @param durationTime 持续时间
 *
 *  @return 计算插值
 */
- (double)outWithGoingTime:(GoingTime)goingTime
                 withStart:(OriginalValue )start
                   withEnd:(ChangedValue )changed
          withDuration:(NSTimeInterval)duration;

/**
 *  插值器类型函数 FMKSTAGE_INOUT
 *
 *  @param goingTime    已运行时间
 *  @param start        起始值
 *  @param changed      改变量
 *  @param durationTime 持续时间
 *
 *  @return 计算插值
 */
- (double)inOutWithGoingTime:(GoingTime)goingTime
                   withStart:(OriginalValue)start
                     withEnd:(ChangedValue )changed
            withDuration:(NSTimeInterval)duration;


@end
