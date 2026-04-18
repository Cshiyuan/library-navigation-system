//
//  FMKLineNode.h
//  FMMapKit
//
//  Created by FengMap on 15/5/25.
//  Copyright (c) 2015年 FengMap. All rights reserved.
//

#import <Foundation/Foundation.h>
#import <UIKit/UIKit.h>
#import "FMKNode.h"

@class FMKImageMarker;
/**
 *  地图的线节点，用于添加地图上的线
 */
typedef NS_ENUM(NSInteger,FMKLineType)
{
    FMKLINE_FULL=0,
    
    FMKLINE_DOTTED,     ///点线 1000100010001000, 表示实际画线的点
    //.  .  .  .  .  .  .  .  .  .  .  .  .  .
    FMKLINE_DOTDASH,    ///点划线    1111111111100100  dot dash
    //____ . ____ . _____ . _____. _____
    FMKLINE_CENTER,     ///中心线    1111111111001100  centre line
    //_____ _ _____ _ _____ _ _____ _ _____
    FMKLINE_DASHED,     ///虚线  1111110011111100   dashed
    //____  ____  ____  ____  ____  ____  ____
    FMKLINE_DOUBLEDOTDASH,      ///双点划线  1111111100100100  double dot dash
    // ____ . . ____ . . ____ . . ____ . . ____
    FMKLINE_TRIDOTDASH,      ///三点划线  111111110101010 tri_dot_dash
    // ____ . . ____ . . ____ . . ____ . . ____
    FMKLINE_TEXTURE,           //动态跨层线段
	FMKLINE_TEXTURE_NORMAL
};

/**
 *  线段大小类型
 */
typedef NS_ENUM(NSInteger, FMKLineMode){
    /**
     *  像素宽度模式 不随放大缩小改变宽度 注：deprecated
     */
    FMKLINE_PIXEL=0,
    /**
     *  空间宽度模式 随放大缩小变化宽度
     */
    FMKLINE_PLANE,
    /**
     *
     */
    FMKLINE_CIRCLE
};

	
@class FMKSegment;

/**
 * 地图线
 */
@interface FMKLineMarker : FMKNode

/// 添加构造线所用的线段标注
- (void)addSegment:(FMKSegment *)segment;

/// 删除构造线所用的线段标注
- (void)removeSegment:(FMKSegment *)segment;

///路径线上线段
@property (readonly) NSArray*   segments;

/**
 *  添加路径动画
 *
 *  @param imageMarker 路径动画的图片标注物  图片标注物必须已经添加到layer层上且layer已添加到地图上
 */
- (void)addAnimationWithImageMarker:(FMKImageMarker *)imageMarker;


/**
 刷新线标注物

 @param groupIDs 要显示线的楼层ID
 */
- (void)refreshLine:(NSArray *)groupIDs;

//*****************************************************

///类型
@property (nonatomic,assign)        FMKLineType type;
///模式
@property (nonatomic,assign)        FMKLineMode mode;
///路线粗细,默认为2
@property (nonatomic,assign)        CGFloat     width;
///路线颜色，默认为蓝色
@property (nonatomic,copy)          UIColor*    color;
///是否隐藏
@property (nonatomic,assign)        BOOL        hidden;
///线标注物的图片名称  图片需保存在FMBundle
@property (nonatomic,copy)			NSString * imageName;
///线标注物外颜色
@property (nonatomic,strong)		UIColor * lineOutColor;
@end








