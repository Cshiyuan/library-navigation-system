//
//  CSYMapViewController.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/8.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "CSYMapViewController.h"
#import "FMMapKit.h"
#import "Masonry.h"
#import "BookInfo.h"
#import "CSYScanQRViewController.h"
#import "CSYSearchBookViewController.h"
#import "UISearchBar+CSYBase.h"

const static float ShowInfoViewHeight = 40;  //信息显示view的大小

@interface CSYMapViewController () <FMKMapViewDelegate, FMKNaviAnalyserDelegate, FMKSearchAnalyserDelegate, UISearchBarDelegate>
{
    
    __weak IBOutlet UIView *_topStatusView;
    __weak IBOutlet UISearchBar *_searchBar;
    
    __weak IBOutlet UIView *_showInfoView;
    __weak IBOutlet UILabel *_showInfoLabel;
    
    /// 地图路径分析对象
    FMKNaviAnalyser *_naviAnalyser;
    /// 点击地图次数，用来判断添加起点还是终点
    
    FMKImageLayer *_imageLayer;
    FMKImageMarker *_startMarker;
    FMKImageMarker *_endMarker;
    
    FMKGeoCoord _startCoord;
    FMKGeoCoord _endCoord;
    
    // Fengmap的搜索分析类
    FMKSearchAnalyser *_searchAnalyser;
    
    Boolean _isSetEnd;
    NSString *_distanceMsg;
    UIColor *_defaultColor;
    
    FMKModel *_startModel;
    FMKModel *_endModel;
}
@property (nonatomic,strong) FMKMapView *mapView;

-(void)p_setButton;
@end

@implementation CSYMapViewController

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    [self hideInfoViewWithAnimation];
    
    _isSetEnd = NO;
    _distanceMsg = @"";
    
    _searchBar.delegate = self;
    _showInfoLabel.numberOfLines = 0;
    _showInfoLabel.textAlignment = NSTextAlignmentCenter;
    
    // 通过地图ID初始化地图视图
    self.mapView = [[FMKMapView alloc] initWithFrame:self.view.frame ID:@"00205100000590132" delegate:self autoUpgrade:NO];
    [self.view addSubview:_mapView];
    
    // 通过主题ID设置主题，ID从蜂鸟官网开发资源中获取
    [_mapView setThemeWithID:@"3002"];
    [self p_setButton];
    
    [self.view bringSubviewToFront:_topStatusView];
    [self.view bringSubviewToFront:_searchBar];
    [self.view bringSubviewToFront:_showInfoView];
    
    //重新设置颜色
    [_searchBar removeBorderWithBackgroundColor:[UIColor colorWithRed:(146.0/255.0) green:(146.0/255.0) blue:(146.0/255.0) alpha:1 ]];
    
    // 通过地图数据路径初始化路径分析
    _naviAnalyser = [[FMKNaviAnalyser alloc] initWithMapID:@"00205100000590132"];
    _naviAnalyser.delegate = self;
    _imageLayer = [[FMKImageLayer alloc] initWithGroupID:@"1"];
    [_mapView.map addLayer:_imageLayer];
    
    //创建搜索分析对象
    _searchAnalyser = [[FMKSearchAnalyser alloc] initWithMapID:@"00205100000590132"];
    //设置搜索代理
    _searchAnalyser.delegate = self;
    
    FMKModelLayer *modelLayer = [_mapView.map getModelLayerByGroupID:@"1"];
    FMKModel *model = [modelLayer queryModelByFID:@"90132023"];
    _defaultColor = model.color;

}

-(void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
    NSUserDefaults *userDefaults = [NSUserDefaults standardUserDefaults];
    BOOL isLogin = [userDefaults boolForKey:@"isLogin"];
    if(!isLogin){
//    if(YES) {
        [self presentLoginViewController];
    }
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
}

-(void)p_setButton
{
    UIButton *scanQRButton = [UIButton buttonWithType:UIButtonTypeCustom];
    scanQRButton.backgroundColor = [UIColor cyanColor];
    scanQRButton.alpha = 0.6;
    scanQRButton.layer.cornerRadius = 10.0;
    scanQRButton.titleLabel.font = [UIFont systemFontOfSize:11];
    scanQRButton.layer.borderWidth = 1.0;
    [scanQRButton setImage:[UIImage imageNamed:@"focus"] forState:UIControlStateNormal];
    [scanQRButton setImageEdgeInsets:UIEdgeInsetsMake(5, 5, 5, 5)];
    [self.view addSubview:scanQRButton];
    [scanQRButton addTarget:self action:@selector(scanButtonTouchDown:) forControlEvents:UIControlEventTouchDown];
    [scanQRButton addTarget:self action:@selector(scanButtonTouchUpInside:) forControlEvents:UIControlEventTouchUpInside];
    [scanQRButton mas_makeConstraints:^(MASConstraintMaker *make) {
        make.bottom.equalTo(self.view.mas_bottom).offset(-100);
        make.right.equalTo(self.view.mas_right).offset(-10);
        make.width.equalTo(self.view.mas_width).multipliedBy(0.12);
        make.height.equalTo(scanQRButton.mas_width);
    }];
    
    
    UIButton *searchBKButton = [UIButton buttonWithType:UIButtonTypeCustom];
    searchBKButton.backgroundColor = [UIColor redColor];
    searchBKButton.alpha = 0.6;
    searchBKButton.layer.cornerRadius = 10.0;
    searchBKButton.layer.borderWidth = 1.0;
    searchBKButton.titleLabel.font = [UIFont systemFontOfSize:11];
    [searchBKButton setTitle:@"找书" forState:UIControlStateNormal];
    [searchBKButton setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [self.view addSubview:searchBKButton];
    [searchBKButton addTarget:self action:@selector(searchBKButtonTouchDown:) forControlEvents:UIControlEventTouchDown];
    [searchBKButton addTarget:self action:@selector(searchBKButtonTouchUpInside:) forControlEvents:UIControlEventTouchUpInside];
    [searchBKButton mas_makeConstraints:^(MASConstraintMaker *make) {
        make.bottom.equalTo(scanQRButton.mas_bottom).offset(-50);
        make.right.equalTo(self.view.mas_right).offset(-10);
        make.width.equalTo(self.view.mas_width).multipliedBy(0.12);
        make.height.equalTo(scanQRButton.mas_width);
    }];
    
}

-(void)showInfoViewWithAnimationByMessage:(NSString*)message
{
    if(_showInfoView.frame.size.height == 0)
    {
        [UIView animateWithDuration:0.3 animations:^{
            //变宽
            CGRect showInfoViewFrame = _showInfoView.frame;
            showInfoViewFrame.size.height = ShowInfoViewHeight;
            _showInfoView.frame = showInfoViewFrame;
            
            _showInfoLabel.frame = _showInfoView.bounds;

            //下移
            CGRect searchBarFrame = _searchBar.frame;
            searchBarFrame.origin.y += ShowInfoViewHeight;
            _searchBar.frame = searchBarFrame;
        } completion:^(BOOL finished) {
            _showInfoLabel.text = message;
        }];
    }
}

-(void)hideInfoViewWithAnimation
{
    
    if(_showInfoView.frame.size.height != 0)
    {
        _showInfoLabel.text = @"";
        [UIView animateWithDuration:0.3 animations:^{
            //变窄
            CGRect showInfoViewFrame = _showInfoView.frame;
            showInfoViewFrame.size.height = 0;
            _showInfoView.frame = showInfoViewFrame;
        
            _showInfoLabel.frame = _showInfoView.bounds;
            //上移
            CGRect searchBarFrame = _searchBar.frame;
            searchBarFrame.origin.y -= ShowInfoViewHeight;
            _searchBar.frame = searchBarFrame;
        }];
    }
    
}

#pragma -mark 按钮响应事件
-(void)scanButtonTouchDown:(UIButton *)btn
{
    [btn setBackgroundColor:[UIColor grayColor]];
}

-(void)scanButtonTouchUpInside:(UIButton *)btn
{
    [btn setBackgroundColor:[UIColor cyanColor]];
    [self hideInfoViewWithAnimation];
    CSYScanQRViewController *vc = [[CSYScanQRViewController alloc]init];
    __weak typeof(self) weakSelf = self;
    vc.scanInfoFromQRBlock = ^(NSString* stringValue)
    {
        //设置搜索条件，搜索多个用"|"号分开
        [weakSelf searchModelByKeyWords:stringValue];
    };
    _isSetEnd = NO;
    [self presentViewController:vc];
}

-(void)searchBKButtonTouchDown:(UIButton *)btn
{
    [btn setBackgroundColor:[UIColor grayColor]];
}

-(void)searchBKButtonTouchUpInside:(UIButton *)btn
{
    [btn setBackgroundColor:[UIColor redColor]];
    [self hideInfoViewWithAnimation];
    CSYSearchBookViewController *vc = [[CSYSearchBookViewController alloc]init];
    __weak typeof(self) weakSelf = self;
    vc.bookInfoBlock = ^(BookInfo* info)
    {
        
        dispatch_time_t timer = dispatch_time(DISPATCH_TIME_NOW, 1 * NSEC_PER_SEC);
        dispatch_after(timer, dispatch_get_main_queue(), ^{
            NSString* msg = [NSString stringWithFormat:@"%@ 所在书架：%@ \n%@",info.bookName,info.slfName,_distanceMsg];
            [self showInfoViewWithAnimationByMessage:msg];
        });
        //设置搜索条件，搜索多个用"|"号分开
        [weakSelf searchModelByKeyWords:info.slfName];
    };
    _isSetEnd = YES;
    [self presentViewController:vc];
}

#pragma -mark UISearchResultsUpdating
- (void)searchBarSearchButtonClicked:(UISearchBar *)searchBar
{
    NSLog(@"search : %@",searchBar.text);
    CSYSearchBookViewController *vc = [[CSYSearchBookViewController alloc]init];
    vc.keyWorkForSearch = searchBar.text;
    __weak typeof(self) weakSelf = self;
    vc.bookInfoBlock = ^(BookInfo* info)
    {
        dispatch_time_t timer = dispatch_time(DISPATCH_TIME_NOW, 1 * NSEC_PER_SEC);
        dispatch_after(timer, dispatch_get_main_queue(), ^{
            NSString* msg = [NSString stringWithFormat:@"%@ 所在书架：%@ \n%@",info.bookName,info.slfName,_distanceMsg];
            [self showInfoViewWithAnimationByMessage:msg];
        });
        //设置搜索条件，搜索多个用"|"号分开
        [weakSelf searchModelByKeyWords:info.slfName];
    };
    _isSetEnd = YES;
    [self presentViewController:vc];

}


#pragma -mark 定制statusBar部分
-(UIStatusBarStyle)preferredStatusBarStyle
{
    return UIStatusBarStyleLightContent;
}

#pragma mark - FMKMapViewDelegate
- (void)mapView:(FMKMapView *)mapView didSingleTapWithPoint:(CGPoint)point
{
    //触碰地图的时候将_searchBar收起
    [_searchBar resignFirstResponder];
}

#pragma mark - 路径规划
/// 路径规划
- (void)naviRouteAnalyserWithStart:(FMKGeoCoord)start end:(FMKGeoCoord)end
{
    // result:保存路径规划得到的点
    NSMutableArray *result = [NSMutableArray array];
    // 路径分析类型设置
    FMKRouteSetting routeSetting;
    routeSetting.naviModule = MODULE_BEST;
    routeSetting.routeCrossGroupPriority = FMKROUTE_CGP_DEFAULT;
    // 进行路径计算分析
    FMKRouteCalculateResultType type = [_naviAnalyser analyseRouteWithStartCoord:start end:end type:routeSetting routeResult:&result];
    //若分析结果不成功，直接返回
    switch (type) {
        case IROUTE_SUCCESS: {
            // 初始化线标注
            FMKLineMarker* line = [[FMKLineMarker alloc] init];
            for (FMKNaviResult* navi in result) {
                //利用分析结果添加segment
                FMKSegment* segment = [[FMKSegment alloc] initWithGroupID:navi.groupID pointArray:navi.pointArray];
                //在直线中添加segment
                [line addSegment:segment];
            }
            [_mapView.map.lineLayer addMarker:line];
        }
            break;
        default:
            break;
    }
}

#pragma mark - FMKNaviAnalyserDelegate
/**
 * 同层结果计算，路径长度
 */
- (void)getFloorRouteLength:(double)length
{
    int min = ceil(length/80);
    _distanceMsg = [NSString stringWithFormat:@"路径总距离：%.2f米  需%d分钟", length, min];

}

#pragma -mark 根据fid搜索公共设施
-(void)searchModelByKeyWords:(NSString*) fid
{
    //创建模型搜索请求对象
    FMKModelSearchRequest *modelRequest = [[FMKModelSearchRequest alloc] init];
    modelRequest.keywords = fid;
    [_searchAnalyser executeFMKSearchRequestByKeyWords:modelRequest];
}

#pragma mark - FMKSearchAnalyserDelegate
//分析结果回调方法
- (void)onModelSearchDone:(FMKModelSearchRequest *)request result:(NSArray *)resultArray
                distances:(NSArray *)distances
{
    //返回的结果是FMKModelSearchResult的数组
    NSLog(@"%@",resultArray);
    FMKModelSearchResult* fmModel = resultArray[0];
    FMKMapPoint point = fmModel.centerCoord;
    FMKGeoCoord coord = FMKGeoCoordMake(1, point);
    
    FMKModelLayer* modelLayer = [_mapView.map getModelLayerByGroupID:@"1"];
    
    if (coord.mapPoint.x == 0 && coord.mapPoint.y == 0) return;
    
    if (!_isSetEnd) {
 
        // 添加终点
        if(_startMarker)
        {
            [_imageLayer removeMarker:_startMarker];
        }
        if(_startModel)
        {
            _startModel.color = _defaultColor;
        }
        
        // 删除原来的marker和路径
        [_imageLayer removeMarker:_startMarker];
        _startMarker = nil;
        [_imageLayer removeMarker:_endMarker];
        _endMarker = nil;
        // 删除所有线标注
        [_mapView.map.lineLayer removeAll];
        
        // 添加起点
        _startMarker = [[FMKImageMarker alloc] initWithImage:[UIImage imageNamed:@"start"] Coord:coord.mapPoint];
        _startMarker.imageSize = CGSizeMake(30, 30);
        _startMarker.offsetMode = FMKImageMarker_USERDEFINE;
        _startMarker.imageOffset = 2;
        [_imageLayer addMarker:_startMarker];
        _startCoord = coord;
        
        //设置颜色
        FMKModel* model = [modelLayer queryModelByFID:fmModel.FID];
        _startModel = model;
        model.color = [UIColor redColor];
        model.selected = YES;
    }
    else {
        // 添加终点
        if(_endMarker)
        {
            [_imageLayer removeMarker:_endMarker];
        }
        if(_endModel)
        {
            _endModel.color = _defaultColor;
        }
        
        _endMarker = [[FMKImageMarker alloc] initWithImage:[UIImage imageNamed:@"end"] Coord:coord.mapPoint];
        _endMarker.imageSize = CGSizeMake(30, 30);
        _endMarker.offsetMode = FMKImageMarker_USERDEFINE;
        _endMarker.imageOffset = 2;
        [_imageLayer addMarker:_endMarker];
        
        _endCoord = coord;
        
        //设置颜色
        FMKModel* model = [modelLayer queryModelByFID:fmModel.FID];
        model.color = [UIColor redColor];
        model.selected = YES;
        _endModel = model;
        // 添加线标注，规划路径
        [self naviRouteAnalyserWithStart:_startCoord end:_endCoord];
    }
    
}

@end
